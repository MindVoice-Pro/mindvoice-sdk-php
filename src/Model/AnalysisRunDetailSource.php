<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Источник данных для AnalysisRunDetail.
 *
 * @property-read string $recordingId
 * @property-read string $transcriptId
 * @property-read string $transcriptionRunId
 * @property-read \stdClass $metadata
 * @property-read string|null $recordedAt
 * @property-read string|null $downloadUrl
 * @property-read string|null $recordingStatus
 * @property-read int|null $durationSeconds
 */
final class AnalysisRunDetailSource extends Model
{
    /** @internal */
    const FIELDS = [
        'recording_id' => ['recordingId', 'string', true, false],
        'transcript_id' => ['transcriptId', 'string', true, false],
        'transcription_run_id' => ['transcriptionRunId', 'string', true, false],
        'metadata' => ['metadata', 'stdClass', true, false],
        'recorded_at' => ['recordedAt', 'string', false, false],
        'download_url' => ['downloadUrl', 'string', false, false],
        'recording_status' => ['recordingStatus', 'string', false, false],
        'duration_seconds' => ['durationSeconds', 'int', false, false],
    ];
}
