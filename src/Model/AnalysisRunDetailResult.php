<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Результат выполнения для AnalysisRunDetail.
 *
 * @property-read string|null $resultId
 * @property-read string|null $summary
 * @property-read string $summaryStatus
 * @property-read list<AnalysisAnswer> $answers
 * @property-read bool $isAnnulled
 * @property-read list<AnalysisCriterionGroup>|null $criterionGroups
 */
final class AnalysisRunDetailResult extends Model
{
    /** @internal */
    const FIELDS = [
        'result_id' => ['resultId', 'string', false, false],
        'summary' => ['summary', 'string', false, false],
        'summary_status' => ['summaryStatus', 'string', true, false],
        'answers' => ['answers', ['list', \MindVoice\Sdk\Model\AnalysisAnswer::class], true, false],
        'is_annulled' => ['isAnnulled', 'bool', true, false],
        'criterion_groups' => ['criterionGroups', ['list', \MindVoice\Sdk\Model\AnalysisCriterionGroup::class], false, false],
    ];
}
