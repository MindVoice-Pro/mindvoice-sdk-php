<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Параметры аудиозаписи для RecordingUpdate.
 *
 * @property-read string|null $recordedAt
 */
final class RecordingUpdateAudio extends Model
{
    /** @internal */
    const FIELDS = [
        'recorded_at' => ['recordedAt', 'string', false, false],
    ];
}
