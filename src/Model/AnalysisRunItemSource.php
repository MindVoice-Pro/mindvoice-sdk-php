<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Источник данных для AnalysisRunItem.
 *
 * @property-read string $recordingId
 * @property-read string $transcriptId
 * @property-read string|null $recordedAt
 */
final class AnalysisRunItemSource extends Model
{
    /** @internal */
    const FIELDS = [
        'recording_id' => ['recordingId', 'string', true, false],
        'transcript_id' => ['transcriptId', 'string', true, false],
        'recorded_at' => ['recordedAt', 'string', false, false],
    ];
}
