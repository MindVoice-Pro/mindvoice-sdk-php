<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Хранение и срок удаления для RecordingItem.
 *
 * @property-read string $uploadedAt
 * @property-read int|null $retentionHours
 * @property-read string|null $retentionExpiresAt
 * @property-read string|null $deletedAt
 * @property-read string|null $deletedBy
 * @property-read bool|null $isAnnulled
 * @property-read string|null $annulledAt
 * @property-read string|null $annulledByUserId
 */
final class RecordingItemStorage extends Model
{
    /** @internal */
    const FIELDS = [
        'uploaded_at' => ['uploadedAt', 'string', true, false],
        'retention_hours' => ['retentionHours', 'int', false, false],
        'retention_expires_at' => ['retentionExpiresAt', 'string', false, false],
        'deleted_at' => ['deletedAt', 'string', false, false],
        'deleted_by' => ['deletedBy', 'string', false, false],
        'is_annulled' => ['isAnnulled', 'bool', false, false],
        'annulled_at' => ['annulledAt', 'string', false, false],
        'annulled_by_user_id' => ['annulledByUserId', 'string', false, false],
    ];
}
