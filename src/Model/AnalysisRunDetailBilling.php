<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Финансовые сведения для AnalysisRunDetail.
 *
 * @property-read TokenUsage $tokenUsage
 * @property-read string $cost
 * @property-read string|null $estimatedCost
 * @property-read TokenCostBreakdown $tokenCost
 */
final class AnalysisRunDetailBilling extends Model
{
    /** @internal */
    const FIELDS = [
        'token_usage' => ['tokenUsage', \MindVoice\Sdk\Model\TokenUsage::class, true, false],
        'cost' => ['cost', 'string', true, false],
        'estimated_cost' => ['estimatedCost', 'string', false, false],
        'token_cost' => ['tokenCost', \MindVoice\Sdk\Model\TokenCostBreakdown::class, true, false],
    ];
}
