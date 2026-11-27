<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Сводные показатели для AnalysisRunDetail.
 *
 * @property-read int $questionsCount
 * @property-read int $flagsCount
 */
final class AnalysisRunDetailStatistics extends Model
{
    /** @internal */
    const FIELDS = [
        'questions_count' => ['questionsCount', 'int', true, false],
        'flags_count' => ['flagsCount', 'int', true, false],
    ];
}
