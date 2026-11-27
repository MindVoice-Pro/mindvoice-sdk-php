<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Список workspace текущего пользователя.
 *
 * @property-read list<WorkspaceItem> $workspaces
 */
final class WorkspaceList extends Model
{
    /** @internal */
    const FIELDS = [
        'workspaces' => ['workspaces', ['list', \MindVoice\Sdk\Model\WorkspaceItem::class], true, false],
    ];
}
