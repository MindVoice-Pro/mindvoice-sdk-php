<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Настройки анализа для AnalysisScenarioItem.
 *
 * @property-read string $llmModelId
 * @property-read string|null $prePrompt
 * @property-read list<AnalysisQuestion> $questions
 * @property-read ModelSettings $modelSettings
 * @property-read ProviderOptions $advancedSettings
 * @property-read list<AnalysisCriterionGroup>|null $criterionGroups
 */
final class AnalysisScenarioItemAnalysis extends Model
{
    /** @internal */
    const FIELDS = [
        'llm_model_id' => ['llmModelId', 'string', true, false],
        'pre_prompt' => ['prePrompt', 'string', false, false],
        'questions' => ['questions', ['list', \MindVoice\Sdk\Model\AnalysisQuestion::class], true, false],
        'model_settings' => ['modelSettings', \MindVoice\Sdk\Model\ModelSettings::class, true, false],
        'advanced_settings' => ['advancedSettings', \MindVoice\Sdk\Model\ProviderOptions::class, true, false],
        'criterion_groups' => ['criterionGroups', ['list', \MindVoice\Sdk\Model\AnalysisCriterionGroup::class], false, false],
    ];
}
