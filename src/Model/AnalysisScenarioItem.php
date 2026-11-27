<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Публичное представление сценария анализа.
 *
 * @property-read string $id
 * @property-read string $name
 * @property-read string|null $description
 * @property-read string $status
 * @property-read int $version
 * @property-read bool $active
 * @property-read AnalysisScenarioItemAnalysis $analysis
 * @property-read AnalysisScenarioItemSummaryGeneration $summaryGeneration
 * @property-read AnalysisScenarioItemTrigger $trigger
 * @property-read AnalysisScenarioItemAudit $audit
 * @property-read AnalysisScenarioItemStatistics $statistics
 */
final class AnalysisScenarioItem extends Model
{
    /** @internal */
    const FIELDS = [
        'id' => ['id', 'string', true, false],
        'name' => ['name', 'string', true, false],
        'description' => ['description', 'string', false, false],
        'status' => ['status', 'string', true, false],
        'version' => ['version', 'int', true, false],
        'active' => ['active', 'bool', true, false],
        'analysis' => ['analysis', \MindVoice\Sdk\Model\AnalysisScenarioItemAnalysis::class, true, false],
        'summary_generation' => ['summaryGeneration', \MindVoice\Sdk\Model\AnalysisScenarioItemSummaryGeneration::class, true, false],
        'trigger' => ['trigger', \MindVoice\Sdk\Model\AnalysisScenarioItemTrigger::class, true, false],
        'audit' => ['audit', \MindVoice\Sdk\Model\AnalysisScenarioItemAudit::class, true, false],
        'statistics' => ['statistics', \MindVoice\Sdk\Model\AnalysisScenarioItemStatistics::class, true, false],
    ];
}
