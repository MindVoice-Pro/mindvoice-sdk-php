<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Сведения о создании и изменении для AnalysisScenarioItem.
 *
 * @property-read string|null $createdBy
 * @property-read string|null $clonedFromId
 * @property-read string $createdAt
 * @property-read string $updatedAt
 */
final class AnalysisScenarioItemAudit extends Model
{
    /** @internal */
    const FIELDS = [
        'created_by' => ['createdBy', 'string', false, false],
        'cloned_from_id' => ['clonedFromId', 'string', false, false],
        'created_at' => ['createdAt', 'string', true, false],
        'updated_at' => ['updatedAt', 'string', true, false],
    ];
}
