<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Настройки формирования резюме для AnalysisScenarioItem.
 *
 * @property-read bool $enabled
 * @property-read string|null $prompt
 * @property-read AnalysisSummaryModelSettings|null $modelSettings
 */
final class AnalysisScenarioItemSummaryGeneration extends Model
{
    /** @internal */
    const FIELDS = [
        'enabled' => ['enabled', 'bool', true, false],
        'prompt' => ['prompt', 'string', false, false],
        'model_settings' => ['modelSettings', \MindVoice\Sdk\Model\AnalysisSummaryModelSettings::class, false, false],
    ];
}
