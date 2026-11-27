<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Сведения об ошибке для TranscriptionRunItem.
 *
 * @property-read string|null $code
 * @property-read string|null $message
 * @property-read string|null $reason
 */
final class TranscriptionRunItemError extends Model
{
    /** @internal */
    const FIELDS = [
        'code' => ['code', 'string', false, false],
        'message' => ['message', 'string', false, false],
        'reason' => ['reason', 'string', false, false],
    ];
}
