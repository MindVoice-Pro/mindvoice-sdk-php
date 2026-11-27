<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение SummaryDetail.
 *
 * @property-read string $overview
 * @property-read list<string> $topics
 * @property-read list<string> $keyEvents
 * @property-read list<string> $problems
 */
final class SummaryDetail extends Model
{
    /** @internal */
    const FIELDS = [
        'overview' => ['overview', 'string', true, false],
        'topics' => ['topics', ['list', 'string'], true, false],
        'key_events' => ['keyEvents', ['list', 'string'], true, false],
        'problems' => ['problems', ['list', 'string'], true, false],
    ];
}
