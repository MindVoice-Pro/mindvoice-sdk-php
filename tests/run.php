<?php

use MindVoice\Sdk\ApiException;
use MindVoice\Sdk\Client;
use MindVoice\Sdk\Internal\MultipartBody;
use MindVoice\Sdk\Internal\Payload;
use MindVoice\Sdk\Model\AnswerValue;
use MindVoice\Sdk\Model\MetadataFilter;
use MindVoice\Sdk\Model\MetadataGroup;
use MindVoice\Sdk\Model\RecordingItem;
use MindVoice\Sdk\Model\RecordingUpdate;
use MindVoice\Sdk\Response;
use MindVoice\Sdk\TranscriptFormat;
use MindVoice\Sdk\TransportInterface;
use MindVoice\Sdk\UploadRecordingInput;

require dirname(__DIR__) . '/vendor/autoload.php';

/** Подменяет HTTP-транспорт и сохраняет отправленные запросы для проверок. */
final class MockTransport implements TransportInterface
{
    public $requests = [];
    private $responses;

    /** Принимает ответы в порядке отправки запросов. */
    public function __construct(array $responses)
    {
        $this->responses = $responses;
    }

    /** Возвращает очередной ответ без сетевых вызовов. */
    public function send($method, $url, array $headers, $body)
    {
        $this->requests[] = [$method, $url, $headers, $body];
        if ($this->responses === []) {
            throw new RuntimeException('Тест не ожидал дополнительного HTTP-запроса.');
        }

        return array_shift($this->responses);
    }
}

/** Прерывает тест с названием не прошедшего ожидания. */
function check($condition, $message)
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

/** Сравнивает значения без преобразований типов. */
function same($expected, $actual, $message)
{
    check($expected === $actual, $message);
}

/** Проверяет тип исключения и при необходимости имя поля в сообщении. */
function rejects($type, Closure $operation, $messagePart = '')
{
    try {
        $operation();
    } catch (Exception $error) {
        check($error instanceof $type, 'Неожиданный тип исключения: ' . get_class($error) . '. ' . $error->getMessage());
        check($messagePart === '' || strpos($error->getMessage(), $messagePart) !== false, 'Сообщение не содержит ожидаемое имя поля.');
        return $error;
    }

    throw new RuntimeException('Ожидалось исключение ' . $type . '.');
}

/** Создаёт нативный поток с содержимым и возвращает его в начало. */
function stream($contents)
{
    $file = fopen('php://temp', 'w+b');
    if ($contents !== '') {
        fwrite($file, $contents);
    }
    rewind($file);

    return $file;
}

/** Составляет JSON-ответ с нативным телом. */
function jsonResponse(array $data, $status = 200)
{
    return new Response($status, ['Content-Type' => 'application/json'], stream(Payload::encode($data)));
}

/** Создаёт клиент с подменой транспорта и префиксом URL. */
function client(MockTransport $transport)
{
    return new Client('test-token', ['baseUrl' => 'https://mindvoice.example/proxy/', 'transport' => $transport]);
}

/** Возвращает запись с обязательными вложенными объектами и точными значениями. */
function recording()
{
    return [
        'id' => 'fl-example',
        'source' => 'upload',
        'file' => ['filename' => 'Запись.wav', 'checksum_algorithm' => 'sha256', 'size_bytes' => '18446744073709551615'],
        'metadata' => json_decode('{"large":9007199254740993,"beyond_int":18446744073709551615,"nil":null,"empty":{}}', false, 512, JSON_BIGINT_AS_STRING),
        'storage' => ['uploaded_at' => '2026-11-26T12:00:00Z'],
        'processing' => ['status' => 'completed'],
        'statistics' => ['transcriptions_count' => 0, 'analyses_count' => 0],
    ];
}

/** Проверяет типизированный список, авторизацию и закрытие JSON-ответа. */
function testWorkspaces()
{
    $response = jsonResponse(['workspaces' => [[
        'id' => 'ws-example',
        'name' => 'Основное пространство',
        'access' => ['role' => 'owner', 'is_default' => false],
        'audit' => ['created_at' => '2026-11-26T12:00:00Z'],
        'new_field' => 'будущее поле',
    ]]]);
    $transport = new MockTransport([$response]);
    $result = client($transport)->listWorkspaces();

    same('ws-example', $result->workspaces[0]->id, 'ID рабочего пространства');
    same(false, $result->workspaces[0]->access->isDefault, 'Логическое значение false');
    same('https://mindvoice.example/proxy/v1/workspaces', $transport->requests[0][1], 'Префикс URL');
    same('Bearer test-token', $transport->requests[0][2]['Authorization'], 'Bearer-авторизация');
    check(!is_resource($response->getBody()), 'Поток JSON закрыт');
}

/** Проверяет повторяемые параметры, кодирование RFC 3986 и форму JSON-фильтров. */
function testRecordingFilters()
{
    $transport = new MockTransport([jsonResponse([
        'recordings' => [recording()],
        'pagination' => ['page_size' => 10, 'offset' => 0, 'total_count' => 1],
        'statistics' => [
            'total_count' => '1',
            'total_size_bytes' => '18446744073709551615',
            'total_duration_seconds' => 0,
            'status_counts' => (object) ['completed' => 1],
        ],
    ])]);
    $result = client($transport)->listRecordings('ws/пример', [
        'pageSize' => 10,
        'offset' => 0,
        'uploadedFrom' => '2026-11-25',
        'status' => ['completed', 'failed'],
        'search' => 'Иван & + /',
        'metadataFilters' => [
            ['field' => 'branch_id', 'operator' => 'equals', 'value' => 'Б-01'],
            MetadataFilter::fromArray(['field' => 'flag', 'operator' => 'exists', 'includeEmpty' => false]),
        ],
        'onlyWithoutTranscription' => false,
    ]);
    $url = $transport->requests[0][1];
    $expected = 'https://mindvoice.example/proxy/v1/workspaces/' . rawurlencode('ws/пример') . '/recordings?'
        . 'page_size=10&offset=0&uploaded_from=2026-11-25&status=completed&status=failed&search=' . rawurlencode('Иван & + /')
        . '&metadata_filters=' . rawurlencode('[{"field":"branch_id","operator":"equals","value":"Б-01"},{"field":"flag","operator":"exists","include_empty":false}]')
        . '&only_without_transcription=false';
    same($expected, $url, 'Сериализация URL и параметров');

    $recording = $result->recordings[0];
    check($recording instanceof RecordingItem, 'Элемент списка является моделью');
    same('18446744073709551615', $recording->file->sizeBytes, 'Точный uint64');
    same(PHP_INT_SIZE >= 8 ? 9007199254740993 : '9007199254740993', $recording->metadata->large, 'Большое JSON-целое');
    same('18446744073709551615', $recording->metadata->beyond_int, 'JSON-целое за пределами PHP');
    check(property_exists($recording->metadata, 'nil') && $recording->metadata->empty instanceof stdClass, 'Форма метаданных');
}

/** Проверяет массивы и объекты в JSON-теле, маску обновления и пустой словарь. */
function testUpdate()
{
    $transport = new MockTransport([
        jsonResponse(['recording' => recording()]),
        jsonResponse(['recording' => recording()]),
    ]);
    $client = client($transport);
    $client->updateRecording('ws-example', 'fl-example', ['updateMask' => 'metadata', 'metadata' => []]);
    $client->updateRecording('ws-example', 'fl-example', RecordingUpdate::fromArray([
        'updateMask' => 'file.filename',
        'file' => ['filename' => 'new.wav'],
    ]));
    same('PATCH', $transport->requests[0][0], 'Метод обновления');
    same('application/json', $transport->requests[0][2]['Content-Type'], 'MIME-тип тела');
    same('{"metadata":{},"update_mask":"metadata"}', $transport->requests[0][3], 'Пустые метаданные являются объектом');
    same('{"file":{"filename":"new.wav"},"update_mask":"file.filename"}', $transport->requests[1][3], 'Вложенная модель');
}

/** Проверяет отсутствие поля, явный null и вложенную группу фильтров. */
function testModelPresence()
{
    $group = MetadataGroup::fromArray(['conditions' => [
        ['field' => 'one', 'operator' => 'exists'],
        ['logic' => 'or', 'conditions' => [['field' => 'two', 'operator' => 'equals', 'value' => null]]],
    ]]);
    check($group->conditions[0] instanceof MetadataFilter, 'Модель плоского фильтра');
    check($group->conditions[1] instanceof MetadataGroup, 'Модель вложенной группы');
    $json = Payload::encode($group);
    check(strpos($json, '"field":"one","operator":"exists"}') !== false, 'Отсутствующее значение пропущено');
    check(strpos($json, '"field":"two","operator":"equals","value":null}') !== false, 'Явный null сохранён');
    same('{"boolean_value":false}', Payload::encode(AnswerValue::fromArray(['booleanValue' => false])), 'Поле false сохранено');
    same('{"text_value":""}', Payload::encode(AnswerValue::fromArray(['textValue' => ''])), 'Пустая строка сохранена');
    rejects('LogicException', function () use ($group) { $group->logic = 'new'; });
}

/** Проверяет загрузку с текущей позиции, выборочные поля и владение исходным файлом. */
function testMultipart()
{
    $source = stream("prefix\xff\x00audio");
    fseek($source, 6);
    try {
        $transport = new MockTransport([jsonResponse(['recording' => recording()])]);
        $result = client($transport)->uploadRecording('ws-example', new UploadRecordingInput([
            'file' => $source,
            'filename' => 'Запись "один".wav',
            'contentType' => 'audio/wav',
            'metadata' => [],
            'recordedAt' => '2026-11-26T00:00:00Z',
            'retentionDays' => 10,
            'checkDuplicates' => false,
        ]));
        same('fl-example', $result->recording->id, 'ID после загрузки');
        same(6, ftell($source), 'Файл не прочитан до начала передачи');
        $body = $transport->requests[0][3];
        check($body instanceof MultipartBody, 'Multipart передаётся потоком');

        // Имитируем порции небольшого размера и сверяем длину с Content-Length.
        $total = '';
        while (($chunk = $body->read(7)) !== '') {
            check(strlen($chunk) <= 7, 'Порция не превышает запрошенный размер');
            $total .= $chunk;
        }
        same(strlen($total), $body->getSize(), 'Длина multipart с учётом смещения');
        check(strpos($total, 'filename="Запись \"один\".wav"') !== false, 'Имя файла экранировано');
        check(strpos($total, "Content-Type: audio/wav\r\n\r\n\xff\x00audio") !== false, 'Содержимое исходного файла');
        check(strpos($total, "Content-Type: application/json\r\n\r\n{}") !== false, 'JSON-часть с метаданными');
        check(strpos($total, "name=\"check_duplicates\"\r\n\r\nfalse") !== false, 'false в multipart');
        check(strpos($total, "name=\"retention_days\"\r\n\r\n10") !== false, 'Срок хранения в multipart');
        check(is_resource($source), 'Исходный поток остаётся открытым');
    } finally {
        fclose($source);
    }
}

/** Проверяет файловый ответ, заголовки диапазона и константу формата экспорта. */
function testFiles()
{
    $audio = stream('audio');
    $export = stream('расшифровка');
    $transport = new MockTransport([
        new Response(206, ['Content-Range' => 'bytes 5-9/10'], $audio),
        new Response(200, ['Content-Type' => 'text/plain'], $export),
    ]);
    try {
        $client = client($transport);
        $result = $client->downloadRecording('ws-example', 'fl-example', ['range' => 'bytes=5-9', 'ifRange' => '"v1"']);
        same(206, $result->getStatusCode(), 'Частичный HTTP-ответ');
        same('bytes 5-9/10', $result->getHeaderLine('CONTENT-RANGE'), 'Регистр заголовков');
        same($audio, $result->getBody(), 'Клиент передаёт открытый поток');
        same(0, ftell($audio), 'Позиция файлового ответа');
        same('bytes=5-9', $transport->requests[0][2]['Range'], 'Заголовок Range');
        same('"v1"', $transport->requests[0][2]['If-Range'], 'Заголовок If-Range');
        $transcript = $client->exportTranscript('ws-example', 'tr-example', ['format' => TranscriptFormat::TXT_TIMESTAMPS]);
        check(strpos($transport->requests[1][1], '?format=txt_timestamps') !== false, 'Название формата в URL');
        same('расшифровка', stream_get_contents($transcript->getBody()), 'Текст файла');
    } finally {
        fclose($audio);
        fclose($export);
    }
}

/** Проверяет последовательность запуска транскрибации и анализа с массивами полей. */
function testRuns()
{
    $now = '2026-11-26T12:00:00Z';
    $transport = new MockTransport([
        jsonResponse(['run' => [
            'id' => 'trn-example',
            'source' => ['recording_id' => 'fl-example'],
            'execution' => ['status' => 'queued', 'created_at' => $now],
            'model' => ['transcription_scenario_id' => 'sct-example'],
            'billing' => ['cost' => '0.0000'],
        ]]),
        jsonResponse(['transcript' => [
            'id' => 'txt-example',
            'recording_id' => 'fl-example',
            'transcription_run_id' => 'trn-example',
            'content' => ['language' => 'ru', 'segments' => [], 'words' => [], 'search_results' => []],
            'summary' => ['status' => 'disabled'],
            'statistics' => ['word_count' => 0, 'characters_with_spaces' => 0, 'characters_without_spaces' => 0],
        ]]),
        jsonResponse(['run' => [
            'id' => 'anl-example',
            'source' => ['recording_id' => 'fl-example', 'transcript_id' => 'txt-example'],
            'execution' => ['status' => 'queued', 'created_at' => $now],
            'retry' => ['retry_count' => 0, 'attempt_count' => 1, 'max_attempts' => 3],
            'model' => ['analysis_scenario_id' => 'sca-example', 'analysis_scenario_version' => 1],
            'billing' => ['token_usage' => ['input_tokens' => '0', 'output_tokens' => '0', 'total_tokens' => '0'], 'cost' => '0.0000'],
        ]]),
    ]);
    $client = client($transport);
    $transcription = $client->startTranscriptionRun('ws-example', 'fl-example', ['transcriptionScenarioId' => 'sct-example']);
    $transcript = $client->getTranscript('ws-example', $transcription->run->id)->transcript;
    $analysis = $client->startAnalysisRun('ws-example', 'fl-example', [
        'analysisScenarioId' => 'sca-example',
        'transcriptId' => $transcript->id,
    ]);
    same('queued', $transcription->run->execution->status, 'Статус транскрибации');
    same('anl-example', $analysis->run->id, 'ID анализа');
    same('0.0000', $analysis->run->billing->cost, 'Стоимость осталась строкой');
    same('{"transcription_scenario_id":"sct-example"}', $transport->requests[0][3], 'Тело запуска транскрибации');
    same('{"analysis_scenario_id":"sca-example","transcript_id":"txt-example"}', $transport->requests[2][3], 'Тело запуска анализа');
}

/** Проверяет структурированную ошибку, запасной ID запроса и закрытие потоков. */
function testErrors()
{
    $structured = jsonResponse(['error' => [
        'code' => 'validation_error',
        'message' => 'Проверьте поля',
        'violations' => [['field_path' => 'metadata.label', 'code' => 'invalid', 'message' => 'Ошибка поля']],
        'request_id' => 'body-request-id',
    ]], 422);
    $large = new Response(416, ['X-Request-ID' => 'header-id', 'Retry-After' => '10', 'Content-Range' => 'bytes */10'], stream(str_repeat('x', 131072)));
    $redirect = new Response(302, ['Location' => 'https://other.example'], stream(''));
    $malformed = new Response(200, [], stream('{"workspaces": []} {}'));
    $client = client(new MockTransport([$structured, $large, $redirect, $malformed]));

    $error = rejects(ApiException::class, function () use ($client) { $client->listWorkspaces(); });
    same(422, $error->statusCode, 'HTTP-статус ошибки');
    same('validation_error', $error->error->code, 'Код API');
    same('metadata.label', $error->error->violations[0]->fieldPath, 'Поле нарушения');
    same('body-request-id', $error->requestId, 'ID запроса из тела');

    $error = rejects(ApiException::class, function () use ($client) { $client->downloadRecording('ws', 'fl'); });
    same(416, $error->statusCode, 'HTTP-статус при большом теле');
    same(null, $error->error, 'Тело ошибки превышает лимит');
    same('header-id', $error->requestId, 'ID запроса из заголовка');
    same('10', $error->retryAfter, 'Заголовок Retry-After');
    same('bytes */10', $error->contentRange, 'Заголовок Content-Range');

    $error = rejects(ApiException::class, function () use ($client) { $client->listWorkspaces(); });
    same(302, $error->statusCode, 'Редирект передан как ошибка');
    rejects('UnexpectedValueException', function () use ($client) { $client->listWorkspaces(); });
    foreach ([$structured, $large, $redirect, $malformed] as $response) {
        check(!is_resource($response->getBody()), 'Тело закрыто при любой ошибке');
    }
}

/** Проверяет, что неверные параметры и неполные модели отклоняются до транспорта. */
function testInvalidInput()
{
    $transport = new MockTransport([]);
    $client = client($transport);
    foreach (['', 'Bearer test-token', "key\r\nheader"] as $key) {
        rejects('InvalidArgumentException', function () use ($key) { new Client($key); }, 'apiKey');
    }
    foreach (['ftp://example.com', 'https://user:password@example.com', 'https://example.com?', 'https://example.com#'] as $url) {
        rejects('InvalidArgumentException', function () use ($url) { new Client('test-token', ['baseUrl' => $url]); }, 'options.baseUrl');
    }
    rejects('InvalidArgumentException', function () { new Client('test-token', ['timeout' => '60']); }, 'options.timeout');
    rejects('InvalidArgumentException', function () use ($client) { $client->listRecordings('..'); }, 'workspace_id');
    rejects('InvalidArgumentException', function () use ($client) { $client->listRecordings(42); }, 'workspace_id');
    rejects('InvalidArgumentException', function () use ($client) { $client->listRecordings('ws', ['pageSize' => '10']); }, 'options.pageSize');
    rejects('InvalidArgumentException', function () use ($client) { $client->listRecordings('ws', ['status' => [false]]); }, 'options.status[0]');
    rejects('InvalidArgumentException', function () use ($client) { $client->listRecordings('ws', ['status' => [1 => 'ready']]); }, 'options.status');
    rejects('InvalidArgumentException', function () use ($client) { $client->listRecordings('ws', ['page_size' => 10]); }, 'options.page_size');
    rejects('InvalidArgumentException', function () use ($client) { $client->updateRecording('ws', 'fl', []); }, 'input.updateMask');
    rejects('InvalidArgumentException', function () use ($client) { $client->updateRecording('ws', 'fl', ['updateMask' => 'file.filename', 'file' => ['filename' => 1]]); }, 'input.file.filename');
    rejects('InvalidArgumentException', function () use ($client) { $client->exportTranscript('ws', 'tr', []); }, 'options.format');
    rejects('InvalidArgumentException', function () use ($client) { $client->exportTranscript('ws', 'tr', ['format' => 'mp3']); }, 'options.format');
    rejects('InvalidArgumentException', function () use ($client) { $client->downloadRecording('ws', 'fl', ['range' => "bytes=1-2\r\nHeader"]); }, 'options.range');
    rejects('InvalidArgumentException', function () use ($client) { $client->uploadRecording('ws', ['file' => 'audio.wav']); }, 'input.file');
    same([], $transport->requests, 'При ошибке входных данных сеть не используется');
}

// Запускаем весь набор на любом поддерживаемом интерпретаторе без тестовых зависимостей.
$tests = ['testWorkspaces', 'testRecordingFilters', 'testUpdate', 'testModelPresence', 'testMultipart', 'testFiles', 'testRuns', 'testErrors', 'testInvalidInput'];
foreach ($tests as $test) {
    try {
        $test();
    } catch (Exception $error) {
        fwrite(STDERR, $test . ': ' . $error->getMessage() . PHP_EOL);
        exit(1);
    }
}
printf("PHP %s: пройдено %d тестов.\n", PHP_VERSION, count($tests));
