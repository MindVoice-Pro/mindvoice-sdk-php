<?php

use MindVoice\Sdk\ApiException;
use MindVoice\Sdk\Client;

require dirname(__DIR__) . '/vendor/autoload.php';

/** Проверяет условие сетевого теста. */
function expectHttp($condition, $message)
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

/** Загружает файл и проверяет, что исходный поток остаётся открытым. */
function verifyUpload(Client $client, $source, array $metadata)
{
    $result = $client->uploadRecording('ws-loopback', [
        'file' => $source,
        'filename' => 'Звонок.wav',
        'contentType' => 'audio/wav',
        'metadata' => $metadata,
        'checkDuplicates' => false,
    ]);
    expectHttp($result->recording->id === 'fl-loopback' && is_resource($source), 'Некорректный результат загрузки.');
}

$baseUrl = 'http://127.0.0.1:' . $argv[1];
$client = new Client('loopback-test-key', ['baseUrl' => $baseUrl]);

// Передаём файл и неперематываемый поток, оба источника закрывает приложение.
$file = tmpfile();
fwrite($file, 'prefix');
ftruncate($file, 16777222);
try {
    verifyUpload($client, $file, ['mode' => 'file']);
} finally {
    fclose($file);
}
$pipe = stream_socket_pair(STREAM_PF_UNIX, STREAM_SOCK_STREAM, STREAM_IPPROTO_IP);
fwrite($pipe[0], 'audio');
fclose($pipe[0]);
try {
    verifyUpload($client, $pipe[1], ['mode' => 'pipe']);
} finally {
    fclose($pipe[1]);
}

// Проверяем передачу JSON-тела и метода PATCH без подмены транспорта.
$updated = $client->updateRecording('ws-loopback', 'fl-loopback', ['updateMask' => 'metadata', 'metadata' => []]);
expectHttp($updated->recording->id === 'fl-loopback', 'Некорректный результат PATCH.');

// Проверяем диапазон и скачиваем файл, превышающий лимит памяти процесса.
$chunk = $client->downloadRecording('ws-loopback', 'fl-loopback', ['range' => 'bytes=5-9']);
try {
    expectHttp($chunk->getStatusCode() === 206, 'Ожидался частичный ответ HTTP 206.');
    expectHttp($chunk->getHeaderLine('Content-Range') === 'bytes 5-9/16777216', 'Отсутствует диапазон.');
    expectHttp(stream_get_contents($chunk->getBody()) === 'audio', 'Некорректные данные диапазона.');
} finally {
    fclose($chunk->getBody());
}
$full = $client->downloadRecording('ws-loopback', 'fl-loopback');
try {
    $body = $full->getBody();
    $hash = hash_init('sha256');
    expectHttp(hash_update_stream($hash, $body) === 16777216, 'Неверный размер скачанного файла.');
    $expected = hash_init('sha256');
    for ($index = 0; $index < 256; $index++) {
        hash_update($expected, str_repeat('z', 65536));
    }
    expectHttp(hash_final($hash) === hash_final($expected), 'Файл изменился при передаче.');
} finally {
    fclose($full->getBody());
}

// Проверяем запрет редиректов и ограничение тела HTTP-ошибки в самом cURL-транспорте.
foreach (['redirect' => 302, 'error' => 429] as $prefix => $status) {
    $client = new Client('loopback-test-key', ['baseUrl' => $baseUrl . '/' . $prefix]);
    try {
        $client->listWorkspaces();
        throw new RuntimeException('Ожидалось исключение по HTTP-статусу.');
    } catch (ApiException $error) {
        expectHttp($error->statusCode === $status, 'Транспорт вернул другой HTTP-статус.');
        if ($status === 429) {
            expectHttp($error->retryAfter === '10' && $error->requestId === 'large-error', 'Потеряны заголовки большого ответа.');
        }
    }
}
printf("PHP %s: cURL, multipart 16 МиБ, поток неизвестной длины, PATCH, HTTP 206, редирект и ошибки прошли.\n", PHP_VERSION);
