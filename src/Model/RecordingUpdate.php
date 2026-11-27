<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Запрос изменения пользовательских полей аудиозаписи.
 *
 * @property-read \stdClass|null $metadata
 * @property-read RecordingUpdateFile|null $file
 * @property-read RecordingUpdateAudio|null $audio
 * @property-read string $updateMask
 */
final class RecordingUpdate extends Model
{
    /** @internal */
    const FIELDS = [
        'metadata' => ['metadata', 'stdClass', false, false],
        'file' => ['file', \MindVoice\Sdk\Model\RecordingUpdateFile::class, false, false],
        'audio' => ['audio', \MindVoice\Sdk\Model\RecordingUpdateAudio::class, false, false],
        'update_mask' => ['updateMask', 'string', true, false],
    ];
}
