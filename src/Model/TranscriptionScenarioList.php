<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Возвращает страницу сценариев транскрибации с общим
 * количеством.
 *
 * @property-read list<TranscriptionScenarioItem> $scenarios
 * @property-read Pagination $pagination
 */
final class TranscriptionScenarioList extends Model
{
    /** @internal */
    const FIELDS = [
        'scenarios' => ['scenarios', ['list', \MindVoice\Sdk\Model\TranscriptionScenarioItem::class], true, false],
        'pagination' => ['pagination', \MindVoice\Sdk\Model\Pagination::class, true, false],
    ];
}
