<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Локализованная неизменяемая редакция универсального
 * критерия.
 *
 * @property-read string $id
 * @property-read int $version
 * @property-read string $category
 * @property-read string $categoryLabel
 * @property-read string $locale
 * @property-read string $name
 * @property-read string $description
 * @property-read AnalysisQuestionInput $question
 */
final class AnalysisTemplateItem extends Model
{
    /** @internal */
    const FIELDS = [
        'id' => ['id', 'string', true, false],
        'version' => ['version', 'int', true, false],
        'category' => ['category', 'string', true, false],
        'category_label' => ['categoryLabel', 'string', true, false],
        'locale' => ['locale', 'string', true, false],
        'name' => ['name', 'string', true, false],
        'description' => ['description', 'string', true, false],
        'question' => ['question', \MindVoice\Sdk\Model\AnalysisQuestionInput::class, true, false],
    ];
}
