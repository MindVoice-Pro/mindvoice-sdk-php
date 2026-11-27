<?php

namespace MindVoice\Sdk\Internal;

use MindVoice\Sdk\Response;
use MindVoice\Sdk\TransportException;
use MindVoice\Sdk\TransportInterface;

/** Передаёт файлы порциями через нативный cURL и сохраняет HTTP-метаданные. */
final class CurlTransport implements TransportInterface
{
    const MAX_ERROR_BYTES = 65536;

    /** @var int */
    private $connectTimeout;

    /** @var int */
    private $timeout;

    /** Принимает проверенные таймауты подключения и всего запроса в секундах. */
    public function __construct($connectTimeout, $timeout)
    {
        $this->connectTimeout = $connectTimeout;
        $this->timeout = $timeout;
    }

    /**
     * Выполняет HTTP-запрос. Ответы больше 1 МиБ пишутся на диск.
     *
     * @param string $method
     * @param string $url
     * @param array<string, string> $headers
     * @param string|MultipartBody|null $body
     * @return Response
     */
    public function send($method, $url, array $headers, $body)
    {
        $curl = curl_init($url);
        if ($curl === false) {
            throw new TransportException('Не удалось создать запрос cURL.');
        }

        $stream = @fopen('php://temp/maxmemory:1048576', 'w+b');
        if ($stream === false) {
            self::close($curl);
            throw new TransportException('Не удалось открыть временный поток ответа.');
        }
        $keepStream = false;
        try {
            // Собираем только последние HTTP-заголовки после ответа прокси или 100 Continue.
            $status = 0;
            $responseHeaders = [];
            $onHeader = static function ($handle, $line) use (&$status, &$responseHeaders) {
                if (preg_match('~\AHTTP/\S+\s+([1-5][0-9]{2})(?:\s|$)~', $line, $matches) === 1) {
                    $status = (int) $matches[1];
                    $responseHeaders = [];
                } elseif (strpos($line, ':') !== false) {
                    list($name, $value) = explode(':', $line, 2);
                    $responseHeaders[strtolower($name)][] = trim($value);
                }

                return strlen($line);
            };

            // Для неуспешного статуса читаем только диагностический фрагмент тела.
            $bytesWritten = 0;
            $truncatedError = false;
            $onData = static function ($handle, $chunk) use ($stream, &$status, &$bytesWritten, &$truncatedError) {
                $length = strlen($chunk);
                if (($status < 200 || $status >= 300) && $bytesWritten + $length > self::MAX_ERROR_BYTES + 1) {
                    $chunk = substr($chunk, 0, self::MAX_ERROR_BYTES + 1 - $bytesWritten);
                    $written = $chunk === '' ? 0 : @fwrite($stream, $chunk);
                    $truncatedError = $written === strlen($chunk);
                    return 0;
                }

                $written = @fwrite($stream, $chunk);
                if ($written === false) {
                    return 0;
                }
                $bytesWritten += $written;

                return $written;
            };

            $options = $this->options($method, $headers, $body);
            $options[CURLOPT_HEADERFUNCTION] = $onHeader;
            $options[CURLOPT_WRITEFUNCTION] = $onData;
            if (!curl_setopt_array($curl, $options)) {
                throw new TransportException('Не удалось настроить запрос cURL.');
            }
            $result = curl_exec($curl);
            $code = curl_errno($curl);
            if ($body instanceof MultipartBody && $body->readFailed()) {
                throw new TransportException('Не удалось прочитать поток загружаемого файла.');
            }
            if ($result === false && !($truncatedError && $code === CURLE_WRITE_ERROR)) {
                throw new TransportException('Ошибка HTTP-транспорта cURL: ' . curl_error($curl), $code);
            }

            $status = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($status < 100 || $status > 599) {
                throw new TransportException('cURL не получил допустимый HTTP-статус.');
            }
            if (!rewind($stream)) {
                throw new TransportException('Не удалось прочитать временный поток ответа.');
            }
            $response = new Response($status, $responseHeaders, $stream);
            $keepStream = true;

            return $response;
        } finally {
            self::close($curl);
            if (!$keepStream) {
                fclose($stream);
            }
        }
    }

    /** Настраивает TLS, запрет перенаправлений и потоковую отправку multipart. */
    private function options($method, array $headers, $body)
    {
        $options = [
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_CONNECTTIMEOUT => $this->connectTimeout,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => true,
        ];
        if (defined('CURLOPT_PROTOCOLS_STR')) {
            $options[CURLOPT_PROTOCOLS_STR] = 'http,https';
        } else {
            $options[CURLOPT_PROTOCOLS] = CURLPROTO_HTTP | CURLPROTO_HTTPS;
        }

        // Для multipart cURL запрашивает порции напрямую у исходного потока.
        if ($body instanceof MultipartBody) {
            $options[CURLOPT_UPLOAD] = true;
            $options[CURLOPT_READFUNCTION] = static function ($handle, $stream, $length) use ($body) {
                return $body->read($length);
            };
            $size = $body->getSize();
            if ($size !== null) {
                $options[CURLOPT_INFILESIZE] = $size;
            }
        } elseif ($body !== null) {
            $options[CURLOPT_POSTFIELDS] = $body;
        }

        $options[CURLOPT_HTTPHEADER] = [];
        foreach ($headers as $name => $value) {
            // В синтаксисе libcurl точка с запятой отправляет именно пустое значение.
            $options[CURLOPT_HTTPHEADER][] = $value === '' ? $name . ';' : $name . ': ' . $value;
        }

        return $options;
    }

    /** Закрывает ресурс в PHP 5/7. Объект PHP 8 освобождается при выходе из send. */
    private static function close($curl)
    {
        if (is_resource($curl)) {
            curl_close($curl);
        }
    }
}
