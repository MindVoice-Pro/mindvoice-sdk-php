<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение TranscriptionRunItemResponse.
 *
 * @property-read TranscriptionRunItem $run
 */
final class TranscriptionRunItemResponse extends Model
{
    /** @internal */
    const FIELDS = [
        'run' => ['run', \MindVoice\Sdk\Model\TranscriptionRunItem::class, true, false],
    ];
}
