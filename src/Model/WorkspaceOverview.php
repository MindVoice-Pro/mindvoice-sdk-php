<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Агрегированный обзор workspace.
 *
 * @property-read string $workspaceId
 * @property-read string $status
 * @property-read WorkspaceOverviewBilling $billing
 * @property-read WorkspaceOverviewStatistics $statistics
 */
final class WorkspaceOverview extends Model
{
    /** @internal */
    const FIELDS = [
        'workspace_id' => ['workspaceId', 'string', true, false],
        'status' => ['status', 'string', true, false],
        'billing' => ['billing', \MindVoice\Sdk\Model\WorkspaceOverviewBilling::class, true, false],
        'statistics' => ['statistics', \MindVoice\Sdk\Model\WorkspaceOverviewStatistics::class, true, false],
    ];
}
