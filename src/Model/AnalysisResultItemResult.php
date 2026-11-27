<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Результат выполнения для AnalysisResultItem.
 *
 * @property-read string|null $summary
 * @property-read list<AnalysisAnswer> $answers
 * @property-read bool $isAnnulled
 * @property-read list<AnalysisCriterionGroup>|null $criterionGroups
 */
final class AnalysisResultItemResult extends Model
{
    /** @internal */
    const FIELDS = [
        'summary' => ['summary', 'string', false, false],
        'answers' => ['answers', ['list', \MindVoice\Sdk\Model\AnalysisAnswer::class], true, false],
        'is_annulled' => ['isAnnulled', 'bool', true, false],
        'criterion_groups' => ['criterionGroups', ['list', \MindVoice\Sdk\Model\AnalysisCriterionGroup::class], false, false],
    ];
}
