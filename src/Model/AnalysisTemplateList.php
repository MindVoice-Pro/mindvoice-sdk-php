<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Актуальные редакции каталога с учётом выбранной категории.
 *
 * @property-read list<AnalysisTemplateItem> $templates
 * @property-read Pagination $pagination
 */
final class AnalysisTemplateList extends Model
{
    /** @internal */
    const FIELDS = [
        'templates' => ['templates', ['list', \MindVoice\Sdk\Model\AnalysisTemplateItem::class], true, false],
        'pagination' => ['pagination', \MindVoice\Sdk\Model\Pagination::class, true, false],
    ];
}
