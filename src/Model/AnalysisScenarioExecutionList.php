<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Возвращает страницу пакетных исполнений сценария.
 *
 * @property-read list<AnalysisScenarioExecutionItem> $executions
 * @property-read Pagination $pagination
 */
final class AnalysisScenarioExecutionList extends Model
{
    /** @internal */
    const FIELDS = [
        'executions' => ['executions', ['list', \MindVoice\Sdk\Model\AnalysisScenarioExecutionItem::class], true, false],
        'pagination' => ['pagination', \MindVoice\Sdk\Model\Pagination::class, true, false],
    ];
}
