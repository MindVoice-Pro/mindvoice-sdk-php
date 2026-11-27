<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Хранение и срок удаления для RecordingImport.
 *
 * @property-read int|null $retentionDays
 */
final class RecordingImportStorage extends Model
{
    /** @internal */
    const FIELDS = [
        'retention_days' => ['retentionDays', 'int', false, false],
    ];
}
