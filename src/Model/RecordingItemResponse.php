<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение RecordingItemResponse.
 *
 * @property-read RecordingItem $recording
 */
final class RecordingItemResponse extends Model
{
    /** @internal */
    const FIELDS = [
        'recording' => ['recording', \MindVoice\Sdk\Model\RecordingItem::class, true, false],
    ];
}
