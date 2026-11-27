<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение RunStatistics.
 *
 * @property-read array<string, int> $statusCounts
 */
final class RunStatistics extends Model
{
    /** @internal */
    const FIELDS = [
        'status_counts' => ['statusCounts', ['map', 'int'], true, false],
    ];
}
