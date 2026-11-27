<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение TranscriptSearchHit.
 *
 * @property-read TimeRange $timeRange
 * @property-read float $confidence
 * @property-read string $snippet
 */
final class TranscriptSearchHit extends Model
{
    /** @internal */
    const FIELDS = [
        'time_range' => ['timeRange', \MindVoice\Sdk\Model\TimeRange::class, true, false],
        'confidence' => ['confidence', 'float', true, false],
        'snippet' => ['snippet', 'string', true, false],
    ];
}
