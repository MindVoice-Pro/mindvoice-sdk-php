<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение WorkspaceBalance.
 *
 * @property-read string|null $amount
 * @property-read string|null $reservedAmount
 * @property-read string|null $availableAmount
 * @property-read string|null $currency
 */
final class WorkspaceBalance extends Model
{
    /** @internal */
    const FIELDS = [
        'amount' => ['amount', 'string', false, false],
        'reserved_amount' => ['reservedAmount', 'string', false, false],
        'available_amount' => ['availableAmount', 'string', false, false],
        'currency' => ['currency', 'string', false, false],
    ];
}
