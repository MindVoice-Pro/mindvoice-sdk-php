<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение TimeRange.
 *
 * @property-read float $startSeconds
 * @property-read float $endSeconds
 */
final class TimeRange extends Model
{
    /** @internal */
    const FIELDS = [
        'start_seconds' => ['startSeconds', 'float', true, false],
        'end_seconds' => ['endSeconds', 'float', true, false],
    ];
}
