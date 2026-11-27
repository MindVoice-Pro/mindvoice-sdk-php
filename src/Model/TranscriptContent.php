<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение TranscriptContent.
 *
 * @property-read string $language
 * @property-read list<TranscriptSegment> $segments
 * @property-read list<TranscriptWord> $words
 * @property-read list<TranscriptSearchResult> $searchResults
 * @property-read bool|null $hasDiarization
 */
final class TranscriptContent extends Model
{
    /** @internal */
    const FIELDS = [
        'language' => ['language', 'string', true, false],
        'segments' => ['segments', ['list', \MindVoice\Sdk\Model\TranscriptSegment::class], true, false],
        'words' => ['words', ['list', \MindVoice\Sdk\Model\TranscriptWord::class], true, false],
        'search_results' => ['searchResults', ['list', \MindVoice\Sdk\Model\TranscriptSearchResult::class], true, false],
        'has_diarization' => ['hasDiarization', 'bool', false, false],
    ];
}
