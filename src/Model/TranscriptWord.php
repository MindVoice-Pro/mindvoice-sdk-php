<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение TranscriptWord.
 *
 * @property-read string $text
 * @property-read TimeRange $timeRange
 * @property-read TimeRange $absoluteTimeRange
 * @property-read string|null $speakerId
 * @property-read float|null $confidence
 */
final class TranscriptWord extends Model
{
    /** @internal */
    const FIELDS = [
        'text' => ['text', 'string', true, false],
        'time_range' => ['timeRange', \MindVoice\Sdk\Model\TimeRange::class, true, false],
        'absolute_time_range' => ['absoluteTimeRange', \MindVoice\Sdk\Model\TimeRange::class, true, false],
        'speaker_id' => ['speakerId', 'string', false, false],
        'confidence' => ['confidence', 'float', false, false],
    ];
}
