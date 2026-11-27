# MindVoice SDK для PHP

Клиент публичного API MindVoice для серверных PHP-приложений. Поддерживает
43 операции с API-ключом Workspace, включая загрузку и импорт аудио, запуски
транскрибации и анализа, получение результатов и скачивание файлов.

[Портал разработчиков MindVoice](https://developer.mindvoice.pro/) ·
[Справочник API](https://developer.mindvoice.pro/api-reference/)

## Установка

Требуются **PHP 5.6, 7.x или 8.x**, расширения **cURL**, **JSON** и **OpenSSL**,
а также Composer. На PHP ниже 7.2.5 используйте Composer 2.2.
[Требования Composer](https://getcomposer.org/doc/00-intro.md#system-requirements)

Пакет называется `mindvoice-pro/sdk`, пространство имён — `MindVoice\Sdk`.
Установите пакет из каталога приложения.

```bash
composer require mindvoice-pro/sdk
```

[Страница пакета на Packagist](https://packagist.org/packages/mindvoice-pro/sdk)

## Первый запрос

В MindVoice откройте **Настройки → Workspace → API-ключи** и создайте ключ
с правами вашей интеграции. Передайте секрет через переменную окружения
`MINDVOICE_API_KEY`. Клиент добавит заголовок `Authorization: Bearer …`.
По умолчанию он обращается к `https://api.mindvoice.pro`.
[Получение API-ключа](https://developer.mindvoice.pro/docs/getting-started/authentication/)

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use MindVoice\Sdk\Client;

$apiKey = getenv('MINDVOICE_API_KEY');
if ($apiKey === false || $apiKey === '') {
    throw new RuntimeException('Задайте MINDVOICE_API_KEY.');
}

$client = new Client($apiKey);
foreach ($client->listWorkspaces()->workspaces as $workspace) {
    printf("%s\t%s\n", $workspace->id, $workspace->name);
}
```

Используйте полученный ID Workspace в остальных методах. Второй аргумент
`Client` — массив настроек. Для тестовой среды или доверенного прокси
укажите `baseUrl`. Параметры `connectTimeout` и `timeout` задают в секундах
время подключения и всего запроса. По умолчанию это 10 и 60 секунд.
Для тестов можно передать реализацию `TransportInterface` в `transport`.
cURL проверяет TLS-сертификат, а HTTP-перенаправления возвращает как ошибки API.

| Операция | Право ключа |
| --- | --- |
| Загрузка и импорт аудио | `recordings:write` |
| Чтение, проверка подготовки и скачивание аудио | `recordings:read` |
| Запуск транскрибации | `transcripts:write` |
| Чтение запусков, получение и экспорт текста расшифровки | `transcripts:read` |
| Запуск анализа | `analysis:write` |
| Чтение сценариев анализа и результатов | `analysis:read` |

## Загрузка и импорт аудио

Передайте читаемый PHP-поток, исходное имя файла и MIME-тип. cURL читает файл
порциями с текущей позиции. После вызова закройте поток в приложении.

```php
$file = fopen('/path/to/call.mp3', 'rb');
if ($file === false) {
    throw new RuntimeException('Не удалось открыть аудиофайл.');
}
try {
    $uploaded = $client->uploadRecording($workspaceId, [
        'file' => $file,
        'filename' => 'call.mp3',
        'contentType' => 'audio/mpeg',
        'metadata' => ['external_id' => 'call-123'],
    ]);
    $recordingId = $uploaded->recording->id;
} finally {
    fclose($file);
}
```

При необходимости укажите `recordedAt` в RFC 3339, срок хранения
`retentionDays` и `checkDuplicates`. API по умолчанию проверяет дубликаты.
Ключи верхнего уровня метаданных должны соответствовать `[a-z0-9_]{1,64}`.
[Форматы аудио и правила метаданных](https://developer.mindvoice.pro/docs/guides/upload-and-results/#1-загрузите-один-или-несколько-файлов)

Для импорта передайте прямую ссылку на аудио, доступную MindVoice.

```php
$imported = $client->importRecording($workspaceId, ['file' => ['url' => $audioUrl]]);
$recordingId = $imported->recording->id;
```

Проверяйте `getRecording($workspaceId, $recordingId)->recording->processing->status`
с паузой между запросами. Статус `completed` означает, что аудио подготовлено.
При `failed`, `download_failed` или `duplicate` проверьте карточку записи
и состояние импорта. [От загрузки до результата](https://developer.mindvoice.pro/docs/guides/upload-and-results/)

## Транскрибация и анализ

Сценарии настраиваются в MindVoice. Для автоматического сценария найдите запуск
через `listTranscriptionRuns` или `listAnalysisRuns` с фильтром `recordingId`.
Для ручного запуска получите ID настроенного сценария из `listTranscriptionScenarios`
или `listAnalysisScenarios`.

```php
$transcription = $client->startTranscriptionRun($workspaceId, $recordingId, [
    'transcriptionScenarioId' => $transcriptionScenarioId,
]);
$transcriptionRunId = $transcription->run->id;
```

Через `getTranscriptionRun` проверяйте `run->execution->status` до
`completed`, `failed` или `cancelled`. После `completed` получите текст
расшифровки и укажите его ID при запуске анализа.

```php
$transcript = $client->getTranscript($workspaceId, $transcriptionRunId)->transcript;
$analysis = $client->startAnalysisRun($workspaceId, $recordingId, [
    'analysisScenarioId' => $analysisScenarioId,
    'transcriptId' => $transcript->id,
]);
$analysisRunId = $analysis->run->id;
```

Проверяйте `getAnalysisRun($workspaceId, $analysisRunId)->run->execution->status`.
После `completed` запросите `getRecordingAnalysisResult($workspaceId, $recordingId, $analysisRunId)`.
Ответы на критерии доступны в `$response->result->result->answers`, резюме — в
`$response->result->result->summary`. При ошибке или отмене проверьте состояние запуска.
[Сценарии](https://developer.mindvoice.pro/docs/guides/scenarios/) ·
[Получение результата анализа](https://developer.mindvoice.pro/docs/guides/upload-and-results/#4-получите-ai-анализ)

## Скачивание файлов

`downloadRecording` возвращает исходное аудио. Для частичного ответа передайте
`['range' => 'bytes=0-1048575']` и, при необходимости, ключ `ifRange`. Проверьте
`getStatusCode()` и `getHeaderLine('Content-Range')` у ответа.
`exportTranscript` поддерживает `TranscriptFormat::SRT`, `VTT`, `TXT` и
`TXT_TIMESTAMPS`. Оба метода возвращают объект `Response` с открытым PHP-потоком
после завершения запроса. Ответы больше 1 МиБ cURL записывает во временный
файл. Закройте поток после чтения, чтобы освободить временное хранилище.

```php
use MindVoice\Sdk\TranscriptFormat;

$response = $client->exportTranscript($workspaceId, $transcriptionRunId, [
    'format' => TranscriptFormat::SRT,
]);
try {
    $output = fopen('/path/to/transcript.srt', 'wb');
    if ($output === false) {
        throw new RuntimeException('Не удалось открыть файл для записи.');
    }
    try {
        if (stream_copy_to_stream($response->getBody(), $output) === false) {
            throw new RuntimeException('Не удалось сохранить текст расшифровки.');
        }
    } finally {
        fclose($output);
    }
} finally {
    fclose($response->getBody());
}
```

## Фильтры и пагинация

Передавайте фильтры массивом с ключами в `lowerCamelCase`. SDK проверяет
типы и кодирует повторяющиеся значения и JSON-фильтры в формате API.

```php
$offset = 0;
do {
    $page = $client->listRecordings($workspaceId, [
        'pageSize' => 50,
        'offset' => $offset,
        'metadataFilters' => [['field' => 'external_id', 'operator' => 'exists']],
    ]);
    foreach ($page->recordings as $recording) {
        echo $recording->id, PHP_EOL;
    }
    $offset += count($page->recordings);
    $total = $page->pagination->totalCount;
} while ($page->recordings !== [] && ($total === null || $offset < $total));
```

Тела JSON-запросов принимают массивы или модели, созданные через `Model::fromArray()`,
например `RecordingUpdate::fromArray(['updateMask' => 'metadata', 'metadata' => []])`.
Свойства моделей доступны для чтения в `lowerCamelCase`. Точные денежные
значения, даты и поля `uint64`, передаваемые API как строки, остаются строками.
Произвольные объекты метаданных читаются как `stdClass`. Целые числа вне
диапазона PHP в произвольном JSON декодируются в строки.
[Правила пагинации и параметры списков](https://developer.mindvoice.pro/docs/guides/pagination/)

## Ошибки и повторы

`ApiException` содержит HTTP-статус, доменную ошибку при наличии корректного
ответа API, ID запроса и значения заголовков `Retry-After` и `Content-Range`.
Неверные параметры отклоняются до HTTP-запроса с `InvalidArgumentException`.
Ошибки соединения и передачи возвращаются как `TransportException`.

```php
use MindVoice\Sdk\ApiException;

try {
    $client->getRecording($workspaceId, $recordingId);
} catch (ApiException $error) {
    fprintf(
        STDERR,
        "HTTP %d, код %s, ID запроса %s\n",
        $error->statusCode,
        $error->error === null ? '—' : $error->error->code,
        $error->requestId === null ? '—' : $error->requestId
    );
}
```

При `422` проверьте `violations` в `$error->error`, если сервер вернул сведения
об ошибке. При `429` учитывайте
`$error->retryAfter`. Повторами управляет приложение. После сетевого сбоя
при создании операции сначала проверьте её состояние. Успешные
`retryTranscriptionRun` и `retryAnalysisRun` возвращают новый ID запуска.
[Обработка ошибок API](https://developer.mindvoice.pro/docs/guides/error-handling/)

## Обновление SDK

Генератор запускается на PHP 8.2 или новее. Для обновления SDK выполните
следующие команды из его каталога.

```bash
composer install
composer --working-dir=tools install
dev-tools make generate
make test
make test-http
make lint
```

Генератор загружает OpenAPI с портала прямо в память и обновляет PHP-методы,
модели и форматы экспорта в синтаксисе PHP 5.6. Для проверки готового SDK
`make test` запускается на любой поддерживаемой версии PHP. `make test-http`
проверяет cURL на локальном сервере. Файл [operation-names.yaml](tools/operation-names.yaml)
закрепляет имена методов по аналогии с Go SDK. Для новой операции без правила
генератор использует её `operationId` в стиле PHP. После обновления проверьте
diff публичных методов и моделей. [Опубликованная спецификация OpenAPI](https://developer.mindvoice.pro/openapi.yaml)
