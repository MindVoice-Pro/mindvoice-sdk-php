<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Сводные показатели для app__transcription__schemas__ScenarioExecutionItem.
 *
 * @property-read int $totalCount
 * @property-read int $queuedCount
 * @property-read int $processingCount
 * @property-read int $completedCount
 * @property-read int $failedCount
 * @property-read int $durationSeconds
 * @property-read int|null $processedDurationSeconds
 * @property-read int|null $preparationTotalCount
 * @property-read int|null $preparationProcessedCount
 * @property-read int|null $preparationSkippedCount
 */
final class TranscriptionScenarioExecutionItemStatistics extends Model
{
    /** @internal */
    const FIELDS = [
        'total_count' => ['totalCount', 'int', true, false],
        'queued_count' => ['queuedCount', 'int', true, false],
        'processing_count' => ['processingCount', 'int', true, false],
        'completed_count' => ['completedCount', 'int', true, false],
        'failed_count' => ['failedCount', 'int', true, false],
        'duration_seconds' => ['durationSeconds', 'int', true, false],
        'processed_duration_seconds' => ['processedDurationSeconds', 'int', false, false],
        'preparation_total_count' => ['preparationTotalCount', 'int', false, false],
        'preparation_processed_count' => ['preparationProcessedCount', 'int', false, false],
        'preparation_skipped_count' => ['preparationSkippedCount', 'int', false, false],
    ];
}
