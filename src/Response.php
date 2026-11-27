<?php

namespace MindVoice\Sdk;

/** HTTP-ответ с заголовками и открытым нативным потоком тела. */
final class Response
{
    /** @var int */
    private $statusCode;

    /** @var array<string, string[]> */
    private $headers;

    /** @var resource */
    private $body;

    /**
     * Принимает HTTP-статус, заголовки и поток ответа.
     *
     * @param int $statusCode
     * @param array<string, string|string[]> $headers
     * @param resource $body
     */
    public function __construct($statusCode, array $headers, $body)
    {
        if (!is_int($statusCode) || $statusCode < 100 || $statusCode > 599 || !is_resource($body)
            || get_resource_type($body) !== 'stream'
        ) {
            throw new \InvalidArgumentException('Укажите допустимый HTTP-статус и открытый поток тела.');
        }

        // В именах заголовков регистр незначим, повторные значения сохраняются.
        $this->headers = [];
        foreach ($headers as $name => $values) {
            $key = strtolower($name);
            $previous = isset($this->headers[$key]) ? $this->headers[$key] : [];
            $this->headers[$key] = array_merge($previous, (array) $values);
        }
        $this->statusCode = $statusCode;
        $this->body = $body;
    }

    /**
     * Возвращает код HTTP-ответа.
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Возвращает заголовки со строчными именами и массивами значений.
     *
     * @return array<string, string[]>
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Возвращает значения заголовка через запятую или пустую строку.
     *
     * @param string $name
     * @return string
     */
    public function getHeaderLine($name)
    {
        $key = strtolower($name);
        return isset($this->headers[$key]) ? implode(', ', $this->headers[$key]) : '';
    }

    /**
     * Возвращает поток тела. После чтения его закрывает вызывающий код.
     *
     * @return resource
     */
    public function getBody()
    {
        return $this->body;
    }
}
