<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Текст расшифровки с типизированным содержимым, резюме и
 * статистикой.
 *
 * @property-read string $id
 * @property-read string $recordingId
 * @property-read string $transcriptionRunId
 * @property-read TranscriptContent $content
 * @property-read TranscriptSummary $summary
 * @property-read TextStatistics $statistics
 * @property-read bool|null $isAnnulled
 */
final class TranscriptItem extends Model
{
    /** @internal */
    const FIELDS = [
        'id' => ['id', 'string', true, false],
        'recording_id' => ['recordingId', 'string', true, false],
        'transcription_run_id' => ['transcriptionRunId', 'string', true, false],
        'content' => ['content', \MindVoice\Sdk\Model\TranscriptContent::class, true, false],
        'summary' => ['summary', \MindVoice\Sdk\Model\TranscriptSummary::class, true, false],
        'statistics' => ['statistics', \MindVoice\Sdk\Model\TextStatistics::class, true, false],
        'is_annulled' => ['isAnnulled', 'bool', false, false],
    ];
}
