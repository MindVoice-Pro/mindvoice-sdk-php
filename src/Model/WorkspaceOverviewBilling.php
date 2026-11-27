<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Финансовые сведения для WorkspaceOverview.
 *
 * @property-read WorkspaceBalance $balance
 * @property-read WorkspaceOverviewPlan $plan
 * @property-read string|null $currentPeriodCost
 */
final class WorkspaceOverviewBilling extends Model
{
    /** @internal */
    const FIELDS = [
        'balance' => ['balance', \MindVoice\Sdk\Model\WorkspaceBalance::class, true, false],
        'plan' => ['plan', \MindVoice\Sdk\Model\WorkspaceOverviewPlan::class, true, false],
        'current_period_cost' => ['currentPeriodCost', 'string', false, false],
    ];
}
