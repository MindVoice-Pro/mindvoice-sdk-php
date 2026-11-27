<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Запрос асинхронного скачивания аудиофайла по прямой
 * ссылке.
 *
 * @property-read \stdClass|null $metadata
 * @property-read RecordingImportFile $file
 * @property-read RecordingImportStorage|null $storage
 * @property-read RecordingImportAudio|null $audio
 * @property-read bool|null $checkDuplicates
 */
final class RecordingImport extends Model
{
    /** @internal */
    const FIELDS = [
        'metadata' => ['metadata', 'stdClass', false, false],
        'file' => ['file', \MindVoice\Sdk\Model\RecordingImportFile::class, true, false],
        'storage' => ['storage', \MindVoice\Sdk\Model\RecordingImportStorage::class, false, false],
        'audio' => ['audio', \MindVoice\Sdk\Model\RecordingImportAudio::class, false, false],
        'check_duplicates' => ['checkDuplicates', 'bool', false, false],
    ];
}
