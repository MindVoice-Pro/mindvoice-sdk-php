<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение TranscriptItemResponse.
 *
 * @property-read TranscriptItem $transcript
 */
final class TranscriptItemResponse extends Model
{
    /** @internal */
    const FIELDS = [
        'transcript' => ['transcript', \MindVoice\Sdk\Model\TranscriptItem::class, true, false],
    ];
}
