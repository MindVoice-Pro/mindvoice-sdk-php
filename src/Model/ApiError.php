<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение ApiError.
 *
 * @property-read string $code
 * @property-read string $message
 * @property-read list<FieldViolation> $violations
 * @property-read \stdClass|null $details
 * @property-read string|null $requestId
 */
final class ApiError extends Model
{
    /** @internal */
    const FIELDS = [
        'code' => ['code', 'string', true, false],
        'message' => ['message', 'string', true, false],
        'violations' => ['violations', ['list', \MindVoice\Sdk\Model\FieldViolation::class], true, false],
        'details' => ['details', 'stdClass', false, false],
        'request_id' => ['requestId', 'string', false, false],
    ];
}
