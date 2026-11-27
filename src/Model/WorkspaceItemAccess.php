<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Права и доступность для WorkspaceItem.
 *
 * @property-read string $role
 * @property-read bool $isDefault
 * @property-read bool|null $canViewFinances
 */
final class WorkspaceItemAccess extends Model
{
    /** @internal */
    const FIELDS = [
        'role' => ['role', 'string', true, false],
        'is_default' => ['isDefault', 'bool', true, false],
        'can_view_finances' => ['canViewFinances', 'bool', false, false],
    ];
}
