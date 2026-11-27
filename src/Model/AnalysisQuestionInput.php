<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Новый или выбранный вопрос при создании сценария.
 *
 * @property-read string $title
 * @property-read string $type
 * @property-read string $prompt
 * @property-read bool|null $required
 * @property-read bool|null $flagWhen
 * @property-read string|null $severity
 * @property-read list<QuestionOption>|null $options
 * @property-read string|null $selectionMode
 * @property-read bool|null $allowNoAnswer
 * @property-read string|null $id
 * @property-read string|null $criterionId
 * @property-read int|null $criterionVersion
 * @property-read string|null $criterionCode
 * @property-read string|null $analyticsAction
 * @property-read string|null $groupId
 * @property-read int|null $weight
 * @property-read string|null $additionalPrompt
 */
final class AnalysisQuestionInput extends Model
{
    /** @internal */
    const FIELDS = [
        'title' => ['title', 'string', true, false],
        'type' => ['type', 'string', true, false],
        'prompt' => ['prompt', 'string', true, false],
        'required' => ['required', 'bool', false, false],
        'flag_when' => ['flagWhen', 'bool', false, false],
        'severity' => ['severity', 'string', false, false],
        'options' => ['options', ['list', \MindVoice\Sdk\Model\QuestionOption::class], false, false],
        'selection_mode' => ['selectionMode', 'string', false, false],
        'allow_no_answer' => ['allowNoAnswer', 'bool', false, false],
        'id' => ['id', 'string', false, false],
        'criterion_id' => ['criterionId', 'string', false, false],
        'criterion_version' => ['criterionVersion', 'int', false, false],
        'criterion_code' => ['criterionCode', 'string', false, false],
        'analytics_action' => ['analyticsAction', 'string', false, false],
        'group_id' => ['groupId', 'string', false, true],
        'weight' => ['weight', 'int', false, false],
        'additional_prompt' => ['additionalPrompt', 'string', false, true],
    ];
}
