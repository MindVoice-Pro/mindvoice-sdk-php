<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение AnalysisAnswer.
 *
 * @property-read AnswerValue $value
 * @property-read float|null $confidence
 * @property-read string|null $explanation
 * @property-read list<Evidence> $evidence
 * @property-read AnswerCriterion $criterion
 * @property-read bool|null $isCritical
 */
final class AnalysisAnswer extends Model
{
    /** @internal */
    const FIELDS = [
        'value' => ['value', \MindVoice\Sdk\Model\AnswerValue::class, true, false],
        'confidence' => ['confidence', 'float', false, false],
        'explanation' => ['explanation', 'string', false, false],
        'evidence' => ['evidence', ['list', \MindVoice\Sdk\Model\Evidence::class], true, false],
        'criterion' => ['criterion', \MindVoice\Sdk\Model\AnswerCriterion::class, true, false],
        'is_critical' => ['isCritical', 'bool', false, false],
    ];
}
