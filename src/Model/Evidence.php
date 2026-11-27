<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение Evidence.
 *
 * @property-read TimeRange $timeRange
 * @property-read string $text
 * @property-read string|null $speakerId
 * @property-read TimeRange|null $absoluteTimeRange
 */
final class Evidence extends Model
{
    /** @internal */
    const FIELDS = [
        'time_range' => ['timeRange', \MindVoice\Sdk\Model\TimeRange::class, true, false],
        'text' => ['text', 'string', true, false],
        'speaker_id' => ['speakerId', 'string', false, false],
        'absolute_time_range' => ['absoluteTimeRange', \MindVoice\Sdk\Model\TimeRange::class, false, false],
    ];
}
