<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Повторы обработки для TranscriptionRunItem.
 *
 * @property-read string|null $retryOfId
 * @property-read int|null $retryCount
 * @property-read int|null $attemptCount
 * @property-read int|null $maxAttempts
 * @property-read string|null $nextAttemptAt
 * @property-read bool|null $retryable
 */
final class TranscriptionRunItemRetry extends Model
{
    /** @internal */
    const FIELDS = [
        'retry_of_id' => ['retryOfId', 'string', false, false],
        'retry_count' => ['retryCount', 'int', false, false],
        'attempt_count' => ['attemptCount', 'int', false, false],
        'max_attempts' => ['maxAttempts', 'int', false, false],
        'next_attempt_at' => ['nextAttemptAt', 'string', false, false],
        'retryable' => ['retryable', 'bool', false, false],
    ];
}
