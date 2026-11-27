<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Возвращает серверную страницу сценариев и размер полной
 * выборки.
 *
 * @property-read list<AnalysisScenarioItem> $scenarios
 * @property-read Pagination $pagination
 */
final class AnalysisScenarioList extends Model
{
    /** @internal */
    const FIELDS = [
        'scenarios' => ['scenarios', ['list', \MindVoice\Sdk\Model\AnalysisScenarioItem::class], true, false],
        'pagination' => ['pagination', \MindVoice\Sdk\Model\Pagination::class, true, false],
    ];
}
