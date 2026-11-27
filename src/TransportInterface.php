<?php

namespace MindVoice\Sdk;

use MindVoice\Sdk\Internal\MultipartBody;

/** Контракт HTTP-транспорта SDK, в том числе для подмены в тестах. */
interface TransportInterface
{
    /**
     * Отправляет запрос и возвращает HTTP-ответ с потоком, установленным в начало.
     *
     * @param string $method
     * @param string $url
     * @param array<string, string> $headers
     * @param string|MultipartBody|null $body
     * @return Response
     */
    public function send($method, $url, array $headers, $body);
}
