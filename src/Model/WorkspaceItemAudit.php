<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Сведения о создании и изменении для WorkspaceItem.
 *
 * @property-read string $createdAt
 */
final class WorkspaceItemAudit extends Model
{
    /** @internal */
    const FIELDS = [
        'created_at' => ['createdAt', 'string', true, false],
    ];
}
