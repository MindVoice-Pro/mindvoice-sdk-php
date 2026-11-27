<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение FieldViolation.
 *
 * @property-read string $fieldPath
 * @property-read string $code
 * @property-read string $message
 */
final class FieldViolation extends Model
{
    /** @internal */
    const FIELDS = [
        'field_path' => ['fieldPath', 'string', true, false],
        'code' => ['code', 'string', true, false],
        'message' => ['message', 'string', true, false],
    ];
}
