<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Источник данных для AnalysisResultItem.
 *
 * @property-read string $recordingId
 * @property-read string $analysisRunId
 * @property-read string $transcriptionRunId
 * @property-read string $analysisScenarioId
 */
final class AnalysisResultItemSource extends Model
{
    /** @internal */
    const FIELDS = [
        'recording_id' => ['recordingId', 'string', true, false],
        'analysis_run_id' => ['analysisRunId', 'string', true, false],
        'transcription_run_id' => ['transcriptionRunId', 'string', true, false],
        'analysis_scenario_id' => ['analysisScenarioId', 'string', true, false],
    ];
}
