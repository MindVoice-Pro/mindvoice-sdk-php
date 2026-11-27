<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Неизменный снимок критерия для отображения ответа и
 * отклонения.
 *
 * @property-read string $title
 * @property-read string $type
 * @property-read string $severity
 * @property-read bool|null $flagWhen
 * @property-read list<QuestionOption>|null $options
 * @property-read string $criterionId
 * @property-read int $criterionVersion
 * @property-read string $criterionCode
 * @property-read string|null $groupId
 * @property-read int|null $weight
 * @property-read string|null $additionalPrompt
 */
final class AnswerCriterion extends Model
{
    /** @internal */
    const FIELDS = [
        'title' => ['title', 'string', true, false],
        'type' => ['type', 'string', true, false],
        'severity' => ['severity', 'string', true, false],
        'flag_when' => ['flagWhen', 'bool', false, false],
        'options' => ['options', ['list', \MindVoice\Sdk\Model\QuestionOption::class], false, false],
        'criterion_id' => ['criterionId', 'string', true, false],
        'criterion_version' => ['criterionVersion', 'int', true, false],
        'criterion_code' => ['criterionCode', 'string', true, false],
        'group_id' => ['groupId', 'string', false, true],
        'weight' => ['weight', 'int', false, false],
        'additional_prompt' => ['additionalPrompt', 'string', false, true],
    ];
}
