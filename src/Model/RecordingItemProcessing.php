<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Состояние обработки для RecordingItem.
 *
 * @property-read string $status
 * @property-read string|null $startedAt
 * @property-read string|null $finishedAt
 */
final class RecordingItemProcessing extends Model
{
    /** @internal */
    const FIELDS = [
        'status' => ['status', 'string', true, false],
        'started_at' => ['startedAt', 'string', false, false],
        'finished_at' => ['finishedAt', 'string', false, false],
    ];
}
