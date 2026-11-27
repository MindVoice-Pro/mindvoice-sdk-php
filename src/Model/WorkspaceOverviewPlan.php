<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Тариф и период текущего обзора Workspace.
 *
 * @property-read string $name
 * @property-read int|null $retentionDays
 * @property-read int|null $retentionHours
 * @property-read bool $isPublic
 * @property-read string $periodStart
 * @property-read string $periodEnd
 */
final class WorkspaceOverviewPlan extends Model
{
    /** @internal */
    const FIELDS = [
        'name' => ['name', 'string', true, false],
        'retention_days' => ['retentionDays', 'int', false, false],
        'retention_hours' => ['retentionHours', 'int', false, false],
        'is_public' => ['isPublic', 'bool', true, false],
        'period_start' => ['periodStart', 'string', true, false],
        'period_end' => ['periodEnd', 'string', true, false],
    ];
}
