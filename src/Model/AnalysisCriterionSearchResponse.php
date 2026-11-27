<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * До пяти актуальных критериев текущего Workspace для повторного
 * использования.
 *
 * @property-read list<AnalysisQuestion> $criteria
 */
final class AnalysisCriterionSearchResponse extends Model
{
    /** @internal */
    const FIELDS = [
        'criteria' => ['criteria', ['list', \MindVoice\Sdk\Model\AnalysisQuestion::class], true, false],
    ];
}
