<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Настройки распознавания для TranscriptionScenarioItem.
 *
 * @property-read string $provider
 * @property-read string $modelId
 * @property-read string $sttModelId
 * @property-read RecognitionSettings $settings
 * @property-read ProviderOptions $advancedSettings
 */
final class TranscriptionScenarioItemRecognition extends Model
{
    /** @internal */
    const FIELDS = [
        'provider' => ['provider', 'string', true, false],
        'model_id' => ['modelId', 'string', true, false],
        'stt_model_id' => ['sttModelId', 'string', true, false],
        'settings' => ['settings', \MindVoice\Sdk\Model\RecognitionSettings::class, true, false],
        'advanced_settings' => ['advancedSettings', \MindVoice\Sdk\Model\ProviderOptions::class, true, false],
    ];
}
