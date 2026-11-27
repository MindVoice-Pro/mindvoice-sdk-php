<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение RecordingStatistics.
 *
 * @property-read string $totalCount
 * @property-read string $totalSizeBytes
 * @property-read float $totalDurationSeconds
 * @property-read array<string, int> $statusCounts
 */
final class RecordingStatistics extends Model
{
    /** @internal */
    const FIELDS = [
        'total_count' => ['totalCount', 'string', true, false],
        'total_size_bytes' => ['totalSizeBytes', 'string', true, false],
        'total_duration_seconds' => ['totalDurationSeconds', 'float', true, false],
        'status_counts' => ['statusCounts', ['map', 'int'], true, false],
    ];
}
