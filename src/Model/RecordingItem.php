<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Аудиозапись: файл, аудиодиагностика, хранение, обработка,
 * импорт и статистика.
 *
 * @property-read string $id
 * @property-read string $source
 * @property-read \stdClass $metadata
 * @property-read RecordingItemFile $file
 * @property-read RecordingItemAudio|null $audio
 * @property-read RecordingItemStorage $storage
 * @property-read RecordingItemProcessing $processing
 * @property-read RecordingItemImportState|null $importState
 * @property-read RecordingItemStatistics $statistics
 */
final class RecordingItem extends Model
{
    /** @internal */
    const FIELDS = [
        'id' => ['id', 'string', true, false],
        'source' => ['source', 'string', true, false],
        'metadata' => ['metadata', 'stdClass', true, false],
        'file' => ['file', \MindVoice\Sdk\Model\RecordingItemFile::class, true, false],
        'audio' => ['audio', \MindVoice\Sdk\Model\RecordingItemAudio::class, false, false],
        'storage' => ['storage', \MindVoice\Sdk\Model\RecordingItemStorage::class, true, false],
        'processing' => ['processing', \MindVoice\Sdk\Model\RecordingItemProcessing::class, true, false],
        'import_state' => ['importState', \MindVoice\Sdk\Model\RecordingItemImportState::class, false, false],
        'statistics' => ['statistics', \MindVoice\Sdk\Model\RecordingItemStatistics::class, true, false],
    ];
}
