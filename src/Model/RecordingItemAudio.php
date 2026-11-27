<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Параметры аудиозаписи для RecordingItem.
 *
 * @property-read int|null $durationSeconds
 * @property-read string|null $recordedAt
 * @property-read AudioInfo|null $technical
 */
final class RecordingItemAudio extends Model
{
    /** @internal */
    const FIELDS = [
        'duration_seconds' => ['durationSeconds', 'int', false, false],
        'recorded_at' => ['recordedAt', 'string', false, false],
        'technical' => ['technical', \MindVoice\Sdk\Model\AudioInfo::class, false, false],
    ];
}
