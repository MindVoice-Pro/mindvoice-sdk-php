<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Сводные показатели для WorkspaceOverview.
 *
 * @property-read string|null $storageBytes
 * @property-read float|null $transcriptionSeconds
 * @property-read int|null $completedTranscriptionsCount
 * @property-read int $filesCount
 * @property-read int $processingCount
 */
final class WorkspaceOverviewStatistics extends Model
{
    /** @internal */
    const FIELDS = [
        'storage_bytes' => ['storageBytes', 'string', false, false],
        'transcription_seconds' => ['transcriptionSeconds', 'float', false, false],
        'completed_transcriptions_count' => ['completedTranscriptionsCount', 'int', false, false],
        'files_count' => ['filesCount', 'int', true, false],
        'processing_count' => ['processingCount', 'int', true, false],
    ];
}
