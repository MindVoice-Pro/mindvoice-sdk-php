<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

/** Генерирует операции и используемые ими модели публичного API MindVoice. */
final class PhpGenerator
{
    private const SCHEMA_REF = '#/components/schemas/';

    /** @var array<string, array> */
    private array $models = [];

    /** @var array<string, string> */
    private array $files = [];

    /** Принимает опубликованный контракт и публичные имена методов SDK. */
    public function __construct(private readonly array $spec, private array $operationNames)
    {
    }

    /** Собирает исходники в памяти до записи файлов в рабочую копию. */
    public function generate(): array
    {
        $methods = [];
        foreach ($this->spec['paths'] as $path => $operations) {
            foreach ($operations as $method => $operation) {
                $id = $operation['operationId'];
                $name = $this->operationNames[$id] ?? lcfirst($id);
                unset($this->operationNames[$id]);
                if (isset($methods[strtolower($name)]) || preg_match('/\A[a-z][A-Za-z0-9]*\z/', $name) !== 1) {
                    throw new RuntimeException("Недопустимое или повторное имя метода {$name}.");
                }
                $methods[strtolower($name)] = $this->operation(strtoupper($method), $path, $operation, $name);
            }
        }
        if ($this->operationNames !== []) {
            throw new RuntimeException('Переименованные операции отсутствуют: ' . implode(', ', array_keys($this->operationNames)));
        }

        // Генерируем транзитивно используемые модели, включая рекурсивные фильтры.
        $pending = array_keys($this->models);
        while ($pending !== []) {
            foreach ($pending as $name) {
                $this->files["src/Model/{$name}.php"] = $this->model($name, $this->models[$name]);
            }
            $pending = array_filter(
                array_keys($this->models),
                fn (string $name): bool => !isset($this->files["src/Model/{$name}.php"]),
            );
        }

        $code = $this->fileHeader('Generated')
            . "use MindVoice\\Sdk\\Model;\nuse MindVoice\\Sdk\\Response;\nuse MindVoice\\Sdk\\UploadRecordingInput;\n\n"
            . "/** Операции публичного API MindVoice. */\ntrait Operations\n{\n"
            . implode("\n\n", $methods) . "\n}\n";
        $this->files['src/Generated/Operations.php'] = $code;

        ksort($this->files);
        return $this->files;
    }

    /** Определяет тип поля и отмечает объектные модели, достижимые из него. */
    private function type(array $schema): string|array
    {
        if (isset($schema['$ref'])) {
            $ref = $schema['$ref'];
            if (!str_starts_with($ref, self::SCHEMA_REF)) {
                throw new RuntimeException("Не поддерживается ссылка {$ref}.");
            }

            $name = substr($ref, strlen(self::SCHEMA_REF));
            $target = $this->spec['components']['schemas'][$name] ?? throw new RuntimeException("Не найдена схема {$name}.");
            if (isset($target['properties'])) {
                $class = str_replace('-', '', $name);
                if (preg_match('/\A[A-Z][A-Za-z0-9]*\z/', $class) !== 1
                    || (isset($this->models[$class]) && $this->models[$class] !== $target)
                ) {
                    throw new RuntimeException("Недопустимое или повторное имя модели {$class}.");
                }
                $this->models[$class] = $target;
                return 'Model\\' . $class;
            }

            return match ($name) {
                'JsonValue' => 'mixed',
                'JsonObject', 'JsonObject-Input', 'JsonObject-Output' => 'stdClass',
                default => $this->type($target),
            };
        }

        // В OpenAPI 3.1 объединение с null выражает допустимость явного null.
        $variants = $schema['anyOf'] ?? $schema['oneOf'] ?? null;
        if ($variants !== null) {
            $types = array_map($this->type(...), $variants);
            $nullable = in_array('null', $types, true);
            $types = array_values(array_filter($types, static fn (string|array $type): bool => $type !== 'null'));
            $types = array_values(array_unique($types, SORT_REGULAR));
            $type = count($types) === 1 ? $types[0] : ['union', $types];

            return $nullable ? ['nullable', $type] : $type;
        }

        return match ($schema['type'] ?? $schema['format'] ?? null) {
            'string', 'date', 'date-time' => 'string',
            'integer' => 'int',
            'number' => 'float',
            'boolean' => 'bool',
            'null' => 'null',
            'array' => ['list', $this->type($schema['items'])],
            'object' => ['map', $this->type($schema['additionalProperties'])],
            default => throw new RuntimeException('Не поддерживается тип схемы: ' . json_encode($schema, JSON_THROW_ON_ERROR)),
        };
    }

    /** Формирует PHPDoc с типами коллекций, моделей и входных массивов. */
    private function docType(string|array $type, bool $modelNamespace = false, bool $input = false): string
    {
        if (is_array($type)) {
            $nested = fn (string|array $item): string => $this->docType($item, $modelNamespace, $input);
            return match ($type[0]) {
                'list' => 'list<' . $nested($type[1]) . '>',
                'map' => 'array<string, ' . $nested($type[1]) . '>',
                'union' => implode('|', array_unique(array_map($nested, $type[1]))),
                'nullable' => $this->nullableType($nested($type[1])),
                'enum' => implode('|', array_map(static fn (string $value): string => var_export($value, true), $type[1])),
            };
        }

        if ($type === 'stdClass') {
            return $input ? '\stdClass|array<string, mixed>' : '\stdClass';
        }
        if (str_starts_with($type, 'Model\\')) {
            $name = $modelNamespace ? substr($type, strlen('Model\\')) : $type;
            return $input ? $name . '|array<string, mixed>' : $name;
        }

        return $type;
    }

    /** Дополняет тип поля в PHPDoc значением null. */
    private function nullableType(string $type): string
    {
        return in_array($type, ['mixed', 'null'], true) ? $type : $type . '|null';
    }

    /** Возвращает PHP-описание типа для преобразования JSON ответа. */
    private function typeCode(string|array $type): string
    {
        if (is_array($type)) {
            $inner = match ($type[0]) {
                'union' => '[' . implode(', ', array_map($this->typeCode(...), $type[1])) . ']',
                'enum' => '[' . implode(', ', array_map(static fn (string $item): string => var_export($item, true), $type[1])) . ']',
                default => $this->typeCode($type[1]),
            };
            return '[' . var_export($type[0], true) . ', ' . $inner . ']';
        }

        if (str_starts_with($type, 'Model\\')) {
            return '\\MindVoice\\Sdk\\' . $type . '::class';
        }

        return var_export($type, true);
    }

    /** Преобразует имя поля контракта в имя свойства и именованного аргумента PHP. */
    private function property(string $name): string
    {
        $property = lcfirst(str_replace(' ', '', ucwords(str_replace(['_', '-'], ' ', $name))));
        if ($property === 'this' || preg_match('/\A[a-zA-Z_][a-zA-Z0-9_]*\z/', $property) !== 1) {
            throw new RuntimeException("Недопустимое имя PHP для поля {$name}.");
        }

        return $property;
    }

    /** Формирует заголовок сгенерированного PHP-файла. */
    private function fileHeader(string $namespace): string
    {
        $suffix = $namespace === '' ? '' : '\\' . $namespace;
        return "<?php\n\n// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.\n\n"
            . "namespace MindVoice\\Sdk{$suffix};\n\n";
    }

    /** Формирует PHPDoc и разбивает описание из контракта по строкам. */
    private function docblock(string $description, string $indent = '', array $tags = []): string
    {
        // Спецификация может содержать многострочные описания и Markdown.
        $description = trim((string) preg_replace('/\s+/u', ' ', str_replace('*/', '* /', $description)));
        $lines = explode("\n", wordwrap($description, 110 - strlen($indent)));
        if ($tags !== []) {
            $lines = array_merge($lines, [''], $tags);
        }
        $body = array_map(static fn (string $line): string => $indent . ($line === '' ? ' *' : ' * ' . $line), $lines);

        return $indent . "/**\n" . implode("\n", $body) . "\n" . $indent . " */\n";
    }

    /** Генерирует описание полей модели и PHPDoc для чтения свойств. */
    private function model(string $name, array $schema): string
    {
        $fields = $tags = $used = [];
        foreach ($schema['properties'] as $wireName => $field) {
            $property = $this->property($wireName);
            if (isset($used[$property])) {
                throw new RuntimeException("Конфликт имён полей {$name}.{$property}.");
            }
            $used[$property] = true;

            // Совместимый базовый класс отличает отсутствующее значение от явного null.
            $type = $this->type($field);
            $required = in_array($wireName, $schema['required'] ?? [], true);
            $nullable = $type === 'mixed' || (is_array($type) && $type[0] === 'nullable');
            $type = is_array($type) && $type[0] === 'nullable' ? $type[1] : $type;
            $doc = $this->docType($type, modelNamespace: true);
            if (!$required || $nullable) {
                $doc = $this->nullableType($doc);
            }
            $tags[] = "@property-read {$doc} \${$property}";
            $fields[] = '        ' . var_export($wireName, true) . ' => ['
                . var_export($property, true) . ', ' . $this->typeCode($type) . ', '
                . var_export($required, true) . ', ' . var_export($nullable, true) . '],';
        }

        return $this->fileHeader('Model') . "use MindVoice\\Sdk\\Internal\\Model;\n\n"
            . $this->docblock($schema['description'] ?? "Модель {$name}.", tags: $tags)
            . "final class {$name} extends Model\n{\n"
            . "    /** @internal */\n    const FIELDS = [\n" . implode("\n", $fields) . "\n    ];\n}\n";
    }

    /** Определяет форму успешного ответа и MIME-типы для файловой операции. */
    private function response(array $operation): array
    {
        $contentTypes = [];
        foreach ($operation['responses'] as $code => $response) {
            if (preg_match('/\A2[0-9]{2}\z/', (string) $code) !== 1) {
                continue;
            }
            foreach ($response['content'] as $mime => $entry) {
                if (isset($contentTypes[$mime]) && $contentTypes[$mime] !== $entry['schema']) {
                    throw new RuntimeException('Успешные HTTP-ответы используют разные схемы.');
                }
                $contentTypes[$mime] = $entry['schema'];
            }
        }

        // Ошибки возвращают общий JSON-конверт, в том числе для файловых методов.
        $this->type(['$ref' => self::SCHEMA_REF . 'ErrorResponse']);
        if (array_keys($contentTypes) === ['application/json']) {
            return [$this->type($contentTypes['application/json']), 'application/json'];
        }
        foreach ($contentTypes as $schema) {
            if (($schema['format'] ?? null) !== 'binary') {
                throw new RuntimeException('Не поддерживается формат успешного ответа.');
            }
        }

        if ($contentTypes === []) {
            throw new RuntimeException('Операция не описывает успешный ответ.');
        }
        return ['Response', implode(', ', array_keys($contentTypes))];
    }

    /** Генерирует метод клиента и схему проверки параметров запроса. */
    private function operation(string $method, string $path, array $operation, string $name): string
    {
        if (($operation['security'] ?? $this->spec['security'] ?? []) !== [['HTTPBearer' => []]]) {
            throw new RuntimeException("Операция {$name} использует неизвестную схему авторизации.");
        }

        [$responseType, $accept] = $this->response($operation);
        $file = $responseType === 'Response';
        if ($file && ($method !== 'GET' || isset($operation['requestBody']))) {
            throw new RuntimeException("Файловая операция {$name} должна использовать GET без тела запроса.");
        }

        $parameters = $tags = $pathValues = $options = $optionDocs = [];
        $requiredOptions = false;
        foreach ($operation['parameters'] ?? [] as $param) {
            $wireName = $param['name'];
            $property = $this->property($wireName);
            $location = $param['in'];
            $json = isset($param['content']['application/json']);
            $schema = $json ? $param['content']['application/json']['schema'] : $param['schema'];
            $type = $this->type($schema);
            $required = $param['required'] ?? false;
            if ($name === 'exportTranscript' && $wireName === 'format') {
                $this->transcriptFormat($schema['enum']);
                $type = ['enum', $schema['enum']];
            }

            // Идентификаторы идут позиционно, фильтры и HTTP-заголовки входят в массив настроек.
            if ($location === 'path') {
                $parameters[] = '$' . $property;
                $tags[] = '@param ' . $this->docType($type) . ' $' . $property;
                $pathValues[] = var_export($wireName, true) . " => [\${$property}, " . $this->typeCode($type) . ']';
                continue;
            }
            if (!in_array($location, ['query', 'header'], true)) {
                throw new RuntimeException("Не поддерживается расположение параметра {$name}.{$wireName}.");
            }
            if ($location === 'query' && (($param['style'] ?? 'form') !== 'form' || ($param['explode'] ?? true) !== true)) {
                throw new RuntimeException("Не поддерживается стиль параметра {$name}.{$wireName}.");
            }
            $requiredOptions = $requiredOptions || $required;
            $optionDocs[] = '    ' . $property . ($required ? '' : '?') . ': ' . $this->docType($type, input: true) . ',';
            $options[] = '            ' . var_export($property, true) . ' => [' . var_export($wireName, true)
                . ', ' . var_export($location, true) . ', ' . $this->typeCode($type)
                . ', ' . var_export($required, true) . ', ' . var_export($json, true) . '],';
        }

        $beforeCall = '';
        $hasBody = isset($operation['requestBody']);
        if ($hasBody) {
            $content = $operation['requestBody']['content'];
            $required = $operation['requestBody']['required'] ?? false;
            $parameters[] = $required ? '$input' : '$input = null';
            switch (array_keys($content)) {
                case ['application/json']:
                    $model = $this->type($content['application/json']['schema']);
                    if (!is_string($model) || !str_starts_with($model, 'Model\\')) {
                        throw new RuntimeException("Ожидалась объектная модель запроса {$name}.");
                    }
                    $input = $model . "::fromInput(\$input, 'input')";
                    $type = $this->docType($model, input: true);
                    break;
                case ['multipart/form-data']:
                    $this->checkUpload($name, $content['multipart/form-data']);
                    if (!$required) {
                        throw new RuntimeException("Ожидалось обязательное тело запроса {$name}.");
                    }
                    $beforeCall .= "        \$upload = \$input instanceof UploadRecordingInput ? \$input : new UploadRecordingInput(\$input);\n";
                    $input = '$upload->multipart()';
                    $type = 'UploadRecordingInput|array<string, mixed>';
                    break;
                default:
                    throw new RuntimeException("Не поддерживается формат запроса {$name}.");
            }
            $tags[] = '@param ' . ($required ? $type : $this->nullableType($type)) . ' $input';
            $beforeCall .= "        \$body = " . ($required ? $input : "\$input === null ? null : {$input}") . ";\n";
        }

        if ($options !== []) {
            if ($requiredOptions && $hasBody && !$required) {
                throw new RuntimeException("Обязательные опции операции {$name} следуют за необязательным телом запроса.");
            }
            $parameters[] = $requiredOptions ? '$options' : '$options = []';
            array_push($tags, '@param array{', ...$optionDocs);
            $tags[] = '} $options';
            $beforeCall .= "        list(\$query, \$headers) = \$this->parameters(\$options, [\n" . implode("\n", $options) . "\n        ]);\n";
        }
        $tags[] = '@return ' . $responseType;

        $route = var_export($path, true);
        if ($pathValues !== []) {
            $route = "\$this->endpoint({$route}, [" . implode(', ', $pathValues) . '])';
        }
        $arguments = $file ? [$route, var_export($accept, true)] : [var_export($method, true), $route, "{$responseType}::class"];
        if ($options !== [] || $hasBody) {
            array_push($arguments, ...($options === [] ? ['[]', '[]'] : ['$query', '$headers']));
        }
        if ($hasBody) {
            $arguments[] = '$body';
        }

        // Сетевую обработку и проверку тела используют все операции клиента.
        $function = $file ? 'requestFile' : 'requestJson';
        $return = "        return \$this->{$function}(\n            " . implode(",\n            ", $arguments) . "\n        );\n";
        $description = $operation['description'] ?? $operation['summary'] ?? 'Вызывает операцию публичного API.';
        return $this->docblock($description, '    ', $tags)
            . "    public function {$name}(" . implode(', ', $parameters) . ")\n    {\n"
            . ($beforeCall === '' ? '' : $beforeCall . "\n") . $return . '    }';
    }

    /** Проверяет, что ручная сборка multipart соответствует полям опубликованной формы. */
    private function checkUpload(string $name, array $content): void
    {
        $schema = $this->spec['components']['schemas']['UploadRecordingForm'];
        $types = [];
        foreach ($schema['properties'] as $field => $property) {
            $types[$field] = $property['$ref'] ?? $property['format'] ?? $property['type'];
        }
        ksort($types);
        if (
            $name !== 'uploadRecording'
            || $content['schema']['$ref'] !== self::SCHEMA_REF . 'UploadRecordingForm'
            || $schema['required'] !== ['file']
            || $types !== [
                'check_duplicates' => 'boolean',
                'file' => 'binary',
                'metadata' => self::SCHEMA_REF . 'JsonObject',
                'recorded_at' => self::SCHEMA_REF . 'Timestamp',
                'retention_days' => 'int32',
            ]
            || ($content['encoding']['metadata']['contentType'] ?? null) !== 'application/json'
        ) {
            throw new RuntimeException('Форма загрузки изменилась; синхронизируйте UploadRecordingInput со спецификацией.');
        }
    }

    /** Генерирует перечисление форматов экспорта текста расшифровки. */
    private function transcriptFormat(array $values): void
    {
        $cases = [];
        foreach ($values as $value) {
            if (preg_match('/\A[a-z][a-z0-9_]*\z/', $value) !== 1) {
                throw new RuntimeException("Некорректное имя формата {$value}.");
            }
            $cases[] = '    const ' . strtoupper($value) . ' = ' . var_export($value, true) . ';';
        }

        $this->files['src/TranscriptFormat.php'] = $this->fileHeader('') . "/** Формат экспорта текста расшифровки. */\n"
            . "final class TranscriptFormat\n{\n" . implode("\n", $cases) . "\n}\n";
    }
}

// Загружаем актуальную спецификацию с портала в память и проверяем ожидаемую версию контракта.
$root = dirname(__DIR__);
$remote = 'https://developer.mindvoice.pro/openapi.yaml';
$curl = curl_init($remote);
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_FOLLOWLOCATION => false,
]);
$yaml = curl_exec($curl);
if ($yaml === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
    throw new RuntimeException('Портал не вернул спецификацию OpenAPI.');
}
unset($curl);
$spec = Yaml::parse($yaml);
if (!str_starts_with($spec['openapi'] ?? '', '3.1.') || ($spec['components']['securitySchemes']['HTTPBearer']['scheme'] ?? null) !== 'bearer') {
    throw new RuntimeException('Не поддерживается версия или схема авторизации опубликованного OpenAPI.');
}
$operationNames = Yaml::parseFile(__DIR__ . '/operation-names.yaml');
$files = (new PhpGenerator($spec, $operationNames))->generate();

// Записываем только сгенерированные файлы. Устаревшие модели удаляем после успешной генерации.
foreach ($files as $file => $contents) {
    $target = "{$root}/{$file}";
    $directory = dirname($target);
    if (!is_dir($directory) && !mkdir($directory, 0777, true)) {
        throw new RuntimeException("Не удалось создать каталог {$directory}.");
    }
    if (file_put_contents($target, $contents) !== strlen($contents)) {
        throw new RuntimeException("Не удалось записать {$file}.");
    }
}
foreach (glob("{$root}/src/Model/*.php") as $target) {
    if (!isset($files['src/Model/' . basename($target)]) && !unlink($target)) {
        throw new RuntimeException("Не удалось удалить устаревшую модель {$target}.");
    }
}

printf("Сгенерировано файлов PHP: %d.\n", count($files));
