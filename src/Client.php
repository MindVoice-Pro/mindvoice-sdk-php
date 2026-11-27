<?php

namespace MindVoice\Sdk;

use MindVoice\Sdk\Generated\Operations;
use MindVoice\Sdk\Internal\CurlTransport;
use MindVoice\Sdk\Internal\Model;
use MindVoice\Sdk\Internal\MultipartBody;
use MindVoice\Sdk\Internal\Payload;
use MindVoice\Sdk\Model\ErrorResponse;
use UnexpectedValueException;

/** Клиент публичного API MindVoice с API-ключом Workspace. */
final class Client
{
    use Operations;

    const DEFAULT_BASE_URL = 'https://api.mindvoice.pro';

    /** @var string */
    private $baseUrl;

    /** @var TransportInterface */
    private $transport;

    /** @var string */
    private $apiKey;

    /**
     * Создаёт клиент. Дополнительный базовый адрес может содержать префикс пути.
     *
     * @param string $apiKey
     * @param array{baseUrl?: string, connectTimeout?: int, timeout?: int, transport?: TransportInterface} $options
     */
    public function __construct(
        #[\SensitiveParameter]
        $apiKey,
        $options = []
    ) {
        if (!is_string($apiKey) || preg_match('/\A[!-~]+\z/', $apiKey) !== 1) {
            throw Payload::invalid('apiKey', true, 'укажите допустимый API-ключ Workspace');
        }
        if (!is_array($options)) {
            throw Payload::invalid('options', true, 'ожидался массив настроек клиента');
        }

        // Конфигурацию проверяем до создания запроса с ключом Workspace.
        $settings = $options + [
            'baseUrl' => self::DEFAULT_BASE_URL,
            'connectTimeout' => 10,
            'timeout' => 60,
            'transport' => null,
        ];
        $baseUrl = $settings['baseUrl'];
        $uri = is_string($baseUrl) ? parse_url($baseUrl) : false;
        if (!is_array($uri) || empty($uri['scheme']) || empty($uri['host'])
            || !in_array(strtolower($uri['scheme']), ['http', 'https'], true)
            || isset($uri['user']) || isset($uri['pass']) || strpbrk($baseUrl, "?#\\") !== false
            || preg_match('/[\x00-\x20\x7f]/', $baseUrl) === 1
        ) {
            throw Payload::invalid('options.baseUrl', true, 'укажите HTTP(S) URL без логина, query и фрагмента');
        }
        foreach (['connectTimeout', 'timeout'] as $name) {
            if (!is_int($settings[$name]) || $settings[$name] < 1) {
                throw Payload::invalid('options.' . $name, true, 'ожидалось положительное число секунд');
            }
        }

        $transport = $settings['transport'];
        if ($transport !== null && !$transport instanceof TransportInterface) {
            throw Payload::invalid('options.transport', true, 'ожидался экземпляр TransportInterface');
        }
        $unknown = array_diff_key($settings, array_flip(['baseUrl', 'connectTimeout', 'timeout', 'transport']));
        if ($unknown !== []) {
            reset($unknown);
            throw Payload::invalid('options.' . key($unknown), true, 'неизвестная настройка');
        }

        $this->apiKey = $apiKey;
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->transport = $transport === null ? new CurlTransport($settings['connectTimeout'], $settings['timeout']) : $transport;
    }

    /**
     * Проверяет идентификаторы и кодирует каждый параметр пути отдельно.
     *
     * @param string $pattern
     * @param array<string, array{mixed, string}> $parameters
     * @return string
     */
    private function endpoint($pattern, array $parameters)
    {
        $replacements = [];
        foreach ($parameters as $name => $parameter) {
            list($value, $type) = $parameter;
            $segment = (string) Payload::convert($value, $type, $name, true);
            if (in_array($segment, ['', '.', '..'], true)) {
                throw Payload::invalid($name, true, 'недопустимый параметр пути');
            }
            $replacements['{' . $name . '}'] = rawurlencode($segment);
        }

        return strtr($pattern, $replacements);
    }

    /**
     * Проверяет параметры вызова и готовит query и заголовки для запроса.
     *
     * @param array<string, mixed> $options
     * @param array<string, array{string, string, string|array, bool, bool}> $spec
     * @return array{array, array}
     */
    private function parameters($options, array $spec)
    {
        if (!is_array($options)) {
            throw Payload::invalid('options', true, 'ожидался массив параметров запроса');
        }

        $query = [];
        $headers = [];
        foreach ($spec as $property => $parameter) {
            list($name, $location, $type, $required, $json) = $parameter;
            $field = 'options.' . $property;
            if (!isset($options[$property])) {
                if ($required) {
                    throw Payload::invalid($field, true, 'обязательный параметр отсутствует');
                }
                unset($options[$property]);
                continue;
            }

            $value = Payload::convert($options[$property], $type, $field, true);
            if ($location === 'header') {
                if (preg_match('/[\x00-\x1f\x7f]/', $value) === 1) {
                    throw Payload::invalid($field, true, 'значение заголовка содержит управляющие символы');
                }
                $headers[$name] = $value;
            } else {
                $query[$name] = $json ? Payload::encode(Payload::toWire($value, $type)) : $value;
            }
            unset($options[$property]);
        }

        if ($options !== []) {
            reset($options);
            throw Payload::invalid('options.' . key($options), true, 'неизвестный параметр запроса');
        }

        return [$query, $headers];
    }

    /**
     * Отправляет запрос и читает типизированный JSON-ответ.
     *
     * @template T of Model
     * @param string $method
     * @param string $path
     * @param class-string<T> $resultClass
     * @param array<string, mixed> $query
     * @param array<string, string> $headers
     * @param Model|MultipartBody|null $input
     * @return T
     */
    private function requestJson($method, $path, $resultClass, array $query = [], array $headers = [], $input = null)
    {
        $headers = ['Accept' => 'application/json'] + $headers;
        $body = null;

        // Контент JSON кодируем заранее, multipart передаём как составной поток.
        if ($input instanceof Model) {
            $headers['Content-Type'] = 'application/json';
            $body = Payload::encode($input);
        } elseif ($input instanceof MultipartBody) {
            $headers['Content-Type'] = $input->getContentType();
            $body = $input;
        }

        $response = $this->send($method, $path, $query, $headers, $body);
        $stream = $response->getBody();
        try {
            $raw = stream_get_contents($stream);
            if ($raw === false) {
                throw new TransportException('Не удалось прочитать JSON-ответ MindVoice.');
            }

            return $resultClass::fromObject(Payload::decode($raw));
        } finally {
            fclose($stream);
        }
    }

    /**
     * Возвращает файловый ответ с открытым потоком и исходными HTTP-метаданными.
     *
     * @param string $path
     * @param string $accept
     * @param array<string, mixed> $query
     * @param array<string, string> $headers
     * @return Response
     */
    private function requestFile($path, $accept, array $query = [], array $headers = [])
    {
        return $this->send('GET', $path, $query, ['Accept' => $accept] + $headers, null);
    }

    /** Добавляет ключ Workspace и проверяет статус до передачи ответа вызывающему коду. */
    private function send($method, $path, array $query, array $headers, $body)
    {
        // Списки в query разворачиваются в повторы имени, false передаётся словом.
        $pairs = [];
        foreach ($query as $name => $values) {
            foreach ((array) $values as $value) {
                if (is_bool($value)) {
                    $value = $value ? 'true' : 'false';
                } elseif (is_float($value)) {
                    $value = Payload::encode($value);
                }
                $pairs[] = rawurlencode($name) . '=' . rawurlencode((string) $value);
            }
        }

        $url = $this->baseUrl . $path . ($pairs === [] ? '' : '?' . implode('&', $pairs));
        $response = $this->transport->send($method, $url, ['Authorization' => 'Bearer ' . $this->apiKey] + $headers, $body);
        $status = $response->getStatusCode();
        if ($status < 200 || $status >= 300) {
            throw $this->readApiError($response);
        }

        return $response;
    }

    /** Читает ограниченный объём HTTP-ошибки и всегда закрывает её тело. */
    private function readApiError(Response $response)
    {
        $stream = $response->getBody();
        $apiError = null;
        try {
            $raw = stream_get_contents($stream, CurlTransport::MAX_ERROR_BYTES + 1);
            if ($raw !== false && strlen($raw) <= CurlTransport::MAX_ERROR_BYTES) {
                $apiError = ErrorResponse::fromObject(Payload::decode($raw))->error;
            }
        } catch (UnexpectedValueException $error) {
            // Без корректного конверта API всё равно возвращаем статус и заголовки.
        } finally {
            fclose($stream);
        }

        $requestId = $response->getHeaderLine('X-Request-ID');
        if ($apiError !== null && $apiError->requestId !== null) {
            $requestId = $apiError->requestId;
        }

        return new ApiException(
            $response->getStatusCode(),
            $apiError,
            $requestId === '' ? null : $requestId,
            $response->getHeaderLine('Retry-After'),
            $response->getHeaderLine('Content-Range')
        );
    }
}
