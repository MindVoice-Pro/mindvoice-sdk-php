<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Выбранная модель для AnalysisRunItem.
 *
 * @property-read string $analysisScenarioId
 * @property-read int $analysisScenarioVersion
 */
final class AnalysisRunItemModel extends Model
{
    /** @internal */
    const FIELDS = [
        'analysis_scenario_id' => ['analysisScenarioId', 'string', true, false],
        'analysis_scenario_version' => ['analysisScenarioVersion', 'int', true, false],
    ];
}
