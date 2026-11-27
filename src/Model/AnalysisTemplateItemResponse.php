<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение AnalysisTemplateItemResponse.
 *
 * @property-read AnalysisTemplateItem $template
 */
final class AnalysisTemplateItemResponse extends Model
{
    /** @internal */
    const FIELDS = [
        'template' => ['template', \MindVoice\Sdk\Model\AnalysisTemplateItem::class, true, false],
    ];
}
