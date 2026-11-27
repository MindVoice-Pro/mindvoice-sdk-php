<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Выбранная модель для AnalysisRunDetail.
 *
 * @property-read string $analysisScenarioId
 * @property-read int $analysisScenarioVersion
 * @property-read string $scenarioName
 * @property-read string $displayName
 * @property-read string $provider
 * @property-read string $snapshotId
 */
final class AnalysisRunDetailModel extends Model
{
    /** @internal */
    const FIELDS = [
        'analysis_scenario_id' => ['analysisScenarioId', 'string', true, false],
        'analysis_scenario_version' => ['analysisScenarioVersion', 'int', true, false],
        'scenario_name' => ['scenarioName', 'string', true, false],
        'display_name' => ['displayName', 'string', true, false],
        'provider' => ['provider', 'string', true, false],
        'snapshot_id' => ['snapshotId', 'string', true, false],
    ];
}
