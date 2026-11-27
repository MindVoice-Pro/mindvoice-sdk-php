<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Возвращает страницу истории пакетных запусков.
 *
 * @property-read list<TranscriptionScenarioExecutionItem> $executions
 * @property-read Pagination $pagination
 */
final class TranscriptionScenarioExecutionList extends Model
{
    /** @internal */
    const FIELDS = [
        'executions' => ['executions', ['list', \MindVoice\Sdk\Model\TranscriptionScenarioExecutionItem::class], true, false],
        'pagination' => ['pagination', \MindVoice\Sdk\Model\Pagination::class, true, false],
    ];
}
