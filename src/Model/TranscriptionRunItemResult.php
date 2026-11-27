<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Результат выполнения для TranscriptionRunItem.
 *
 * @property-read string|null $summaryStatus
 * @property-read bool|null $hasSummary
 * @property-read bool|null $hasDiarization
 * @property-read bool|null $isAnnulled
 */
final class TranscriptionRunItemResult extends Model
{
    /** @internal */
    const FIELDS = [
        'summary_status' => ['summaryStatus', 'string', false, false],
        'has_summary' => ['hasSummary', 'bool', false, false],
        'has_diarization' => ['hasDiarization', 'bool', false, false],
        'is_annulled' => ['isAnnulled', 'bool', false, false],
    ];
}
