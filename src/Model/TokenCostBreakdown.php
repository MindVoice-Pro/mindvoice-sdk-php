<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Раздельные точные стоимости входных и выходных токенов.
 *
 * @property-read string|null $inputCost
 * @property-read string|null $outputCost
 * @property-read string|null $currency
 */
final class TokenCostBreakdown extends Model
{
    /** @internal */
    const FIELDS = [
        'input_cost' => ['inputCost', 'string', false, false],
        'output_cost' => ['outputCost', 'string', false, false],
        'currency' => ['currency', 'string', false, false],
    ];
}
