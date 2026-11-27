<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Источник данных для TranscriptionRunItem.
 *
 * @property-read string $recordingId
 * @property-read string|null $filename
 * @property-read int|null $durationSeconds
 * @property-read \stdClass|null $metadata
 * @property-read string|null $origin
 * @property-read string|null $recordedAt
 * @property-read string|null $downloadUrl
 * @property-read string|null $recordingStatus
 */
final class TranscriptionRunItemSource extends Model
{
    /** @internal */
    const FIELDS = [
        'recording_id' => ['recordingId', 'string', true, false],
        'filename' => ['filename', 'string', false, false],
        'duration_seconds' => ['durationSeconds', 'int', false, false],
        'metadata' => ['metadata', 'stdClass', false, false],
        'origin' => ['origin', 'string', false, false],
        'recorded_at' => ['recordedAt', 'string', false, false],
        'download_url' => ['downloadUrl', 'string', false, false],
        'recording_status' => ['recordingStatus', 'string', false, false],
    ];
}
