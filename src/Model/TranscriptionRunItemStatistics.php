<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Сводные показатели для TranscriptionRunItem.
 *
 * @property-read int|null $wordCount
 * @property-read int|null $charactersWithSpaces
 * @property-read int|null $charactersWithoutSpaces
 * @property-read int|null $analysesCount
 */
final class TranscriptionRunItemStatistics extends Model
{
    /** @internal */
    const FIELDS = [
        'word_count' => ['wordCount', 'int', false, false],
        'characters_with_spaces' => ['charactersWithSpaces', 'int', false, false],
        'characters_without_spaces' => ['charactersWithoutSpaces', 'int', false, false],
        'analyses_count' => ['analysesCount', 'int', false, false],
    ];
}
