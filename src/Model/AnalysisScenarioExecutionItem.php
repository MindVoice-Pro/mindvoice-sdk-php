<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Агрегированный результат пакетного запуска сценария.
 *
 * @property-read string $id
 * @property-read string $scenarioId
 * @property-read string $scenarioType
 * @property-read string $triggerType
 * @property-read AnalysisScenarioExecutionItemExecution $execution
 * @property-read AnalysisScenarioExecutionItemStatistics $statistics
 */
final class AnalysisScenarioExecutionItem extends Model
{
    /** @internal */
    const FIELDS = [
        'id' => ['id', 'string', true, false],
        'scenario_id' => ['scenarioId', 'string', true, false],
        'scenario_type' => ['scenarioType', 'string', true, false],
        'trigger_type' => ['triggerType', 'string', true, false],
        'execution' => ['execution', \MindVoice\Sdk\Model\AnalysisScenarioExecutionItemExecution::class, true, false],
        'statistics' => ['statistics', \MindVoice\Sdk\Model\AnalysisScenarioExecutionItemStatistics::class, true, false],
    ];
}
