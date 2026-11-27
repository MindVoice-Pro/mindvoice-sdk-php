<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Сводные показатели для RecordingItem.
 *
 * @property-read int $transcriptionsCount
 * @property-read int $analysesCount
 */
final class RecordingItemStatistics extends Model
{
    /** @internal */
    const FIELDS = [
        'transcriptions_count' => ['transcriptionsCount', 'int', true, false],
        'analyses_count' => ['analysesCount', 'int', true, false],
    ];
}
