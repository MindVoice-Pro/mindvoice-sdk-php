<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Запрос запуска анализа с необязательным выбором
 * конкретного transcript.
 *
 * @property-read string $analysisScenarioId
 * @property-read string|null $transcriptId
 */
final class AnalysisRunCreate extends Model
{
    /** @internal */
    const FIELDS = [
        'analysis_scenario_id' => ['analysisScenarioId', 'string', true, false],
        'transcript_id' => ['transcriptId', 'string', false, false],
    ];
}
