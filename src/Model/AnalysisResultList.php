<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение AnalysisResultList.
 *
 * @property-read list<AnalysisResultItem> $results
 * @property-read Pagination $pagination
 */
final class AnalysisResultList extends Model
{
    /** @internal */
    const FIELDS = [
        'results' => ['results', ['list', \MindVoice\Sdk\Model\AnalysisResultItem::class], true, false],
        'pagination' => ['pagination', \MindVoice\Sdk\Model\Pagination::class, true, false],
    ];
}
