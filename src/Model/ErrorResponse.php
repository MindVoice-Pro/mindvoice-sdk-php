<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение ErrorResponse.
 *
 * @property-read ApiError $error
 */
final class ErrorResponse extends Model
{
    /** @internal */
    const FIELDS = [
        'error' => ['error', \MindVoice\Sdk\Model\ApiError::class, true, false],
    ];
}
