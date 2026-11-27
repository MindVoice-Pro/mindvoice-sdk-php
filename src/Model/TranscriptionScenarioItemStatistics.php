<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Сводные показатели для TranscriptionScenarioItem.
 *
 * @property-read int $runs
 * @property-read int $successRuns
 * @property-read int $failedRuns
 * @property-read string|null $lastRunAt
 */
final class TranscriptionScenarioItemStatistics extends Model
{
    /** @internal */
    const FIELDS = [
        'runs' => ['runs', 'int', true, false],
        'success_runs' => ['successRuns', 'int', true, false],
        'failed_runs' => ['failedRuns', 'int', true, false],
        'last_run_at' => ['lastRunAt', 'string', false, false],
    ];
}
