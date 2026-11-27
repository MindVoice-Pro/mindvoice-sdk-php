<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Страница анализа с общим числом строк и счётчиками
 * статусов.
 *
 * @property-read list<AnalysisRunDetail> $runs
 * @property-read Pagination $pagination
 * @property-read RunStatistics $statistics
 */
final class AnalysisRunList extends Model
{
    /** @internal */
    const FIELDS = [
        'runs' => ['runs', ['list', \MindVoice\Sdk\Model\AnalysisRunDetail::class], true, false],
        'pagination' => ['pagination', \MindVoice\Sdk\Model\Pagination::class, true, false],
        'statistics' => ['statistics', \MindVoice\Sdk\Model\RunStatistics::class, true, false],
    ];
}
