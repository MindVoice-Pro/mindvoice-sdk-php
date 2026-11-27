<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Повторы обработки для AnalysisRunDetail.
 *
 * @property-read string|null $retryOfId
 * @property-read int $retryCount
 * @property-read int $attemptCount
 * @property-read int $maxAttempts
 * @property-read string|null $nextAttemptAt
 * @property-read bool $retryable
 */
final class AnalysisRunDetailRetry extends Model
{
    /** @internal */
    const FIELDS = [
        'retry_of_id' => ['retryOfId', 'string', false, false],
        'retry_count' => ['retryCount', 'int', true, false],
        'attempt_count' => ['attemptCount', 'int', true, false],
        'max_attempts' => ['maxAttempts', 'int', true, false],
        'next_attempt_at' => ['nextAttemptAt', 'string', false, false],
        'retryable' => ['retryable', 'bool', true, false],
    ];
}
