<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Настройки формирования резюме для TranscriptionScenarioItem.
 *
 * @property-read bool $enabled
 * @property-read string|null $llmModelId
 * @property-read ModelSettings|null $modelSettings
 * @property-read ProviderOptions|null $advancedSettings
 */
final class TranscriptionScenarioItemSummaryGeneration extends Model
{
    /** @internal */
    const FIELDS = [
        'enabled' => ['enabled', 'bool', true, false],
        'llm_model_id' => ['llmModelId', 'string', false, false],
        'model_settings' => ['modelSettings', \MindVoice\Sdk\Model\ModelSettings::class, false, false],
        'advanced_settings' => ['advancedSettings', \MindVoice\Sdk\Model\ProviderOptions::class, false, false],
    ];
}
