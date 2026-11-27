<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение TextStatistics.
 *
 * @property-read int $wordCount
 * @property-read int $charactersWithSpaces
 * @property-read int $charactersWithoutSpaces
 */
final class TextStatistics extends Model
{
    /** @internal */
    const FIELDS = [
        'word_count' => ['wordCount', 'int', true, false],
        'characters_with_spaces' => ['charactersWithSpaces', 'int', true, false],
        'characters_without_spaces' => ['charactersWithoutSpaces', 'int', true, false],
    ];
}
