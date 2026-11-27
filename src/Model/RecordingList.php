<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Cursor-страница списка аудиозаписей.
 *
 * @property-read list<RecordingItem> $recordings
 * @property-read Pagination $pagination
 * @property-read RecordingStatistics $statistics
 */
final class RecordingList extends Model
{
    /** @internal */
    const FIELDS = [
        'recordings' => ['recordings', ['list', \MindVoice\Sdk\Model\RecordingItem::class], true, false],
        'pagination' => ['pagination', \MindVoice\Sdk\Model\Pagination::class, true, false],
        'statistics' => ['statistics', \MindVoice\Sdk\Model\RecordingStatistics::class, true, false],
    ];
}
