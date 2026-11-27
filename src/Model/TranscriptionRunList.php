<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Страница запусков с общим количеством и распределением
 * статусов.
 *
 * @property-read list<TranscriptionRunItem> $runs
 * @property-read Pagination $pagination
 * @property-read RunStatistics $statistics
 */
final class TranscriptionRunList extends Model
{
    /** @internal */
    const FIELDS = [
        'runs' => ['runs', ['list', \MindVoice\Sdk\Model\TranscriptionRunItem::class], true, false],
        'pagination' => ['pagination', \MindVoice\Sdk\Model\Pagination::class, true, false],
        'statistics' => ['statistics', \MindVoice\Sdk\Model\RunStatistics::class, true, false],
    ];
}
