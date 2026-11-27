<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * DTO workspace в списке доступных контуров.
 *
 * @property-read string $id
 * @property-read string $name
 * @property-read string|null $description
 * @property-read string|null $subscriberId
 * @property-read WorkspaceItemAccess $access
 * @property-read WorkspaceItemAudit $audit
 */
final class WorkspaceItem extends Model
{
    /** @internal */
    const FIELDS = [
        'id' => ['id', 'string', true, false],
        'name' => ['name', 'string', true, false],
        'description' => ['description', 'string', false, false],
        'subscriber_id' => ['subscriberId', 'string', false, false],
        'access' => ['access', \MindVoice\Sdk\Model\WorkspaceItemAccess::class, true, false],
        'audit' => ['audit', \MindVoice\Sdk\Model\WorkspaceItemAudit::class, true, false],
    ];
}
