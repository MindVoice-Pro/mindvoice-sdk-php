<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Состояние импорта для RecordingItem.
 *
 * @property-read int|null $attemptCount
 * @property-read string|null $nextAttemptAt
 * @property-read string|null $errorCode
 * @property-read string|null $errorMessage
 * @property-read string|null $downloadedAt
 */
final class RecordingItemImportState extends Model
{
    /** @internal */
    const FIELDS = [
        'attempt_count' => ['attemptCount', 'int', false, false],
        'next_attempt_at' => ['nextAttemptAt', 'string', false, false],
        'error_code' => ['errorCode', 'string', false, false],
        'error_message' => ['errorMessage', 'string', false, false],
        'downloaded_at' => ['downloadedAt', 'string', false, false],
    ];
}
