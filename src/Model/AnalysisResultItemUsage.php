<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Объём использования для AnalysisResultItem.
 *
 * @property-read TokenUsage $tokenUsage
 */
final class AnalysisResultItemUsage extends Model
{
    /** @internal */
    const FIELDS = [
        'token_usage' => ['tokenUsage', \MindVoice\Sdk\Model\TokenUsage::class, true, false],
    ];
}
