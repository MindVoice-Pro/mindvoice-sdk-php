<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Условия запуска для AnalysisScenarioItem.
 *
 * @property-read string $triggerType
 * @property-read ScenarioSchedule|null $schedule
 * @property-read AnalysisSourceFilter $sourceFilter
 */
final class AnalysisScenarioItemTrigger extends Model
{
    /** @internal */
    const FIELDS = [
        'trigger_type' => ['triggerType', 'string', true, false],
        'schedule' => ['schedule', \MindVoice\Sdk\Model\ScenarioSchedule::class, false, false],
        'source_filter' => ['sourceFilter', \MindVoice\Sdk\Model\AnalysisSourceFilter::class, true, false],
    ];
}
