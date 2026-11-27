<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Ровно один вид ответа; protobuf oneof value. Список обёрнут в message, так
 * как repeated нельзя поместить в oneof.
 *
 * @property-read bool|null $booleanValue
 * @property-read string|null $textValue
 * @property-read SelectedOptions|null $selectedOptions
 */
final class AnswerValue extends Model
{
    /** @internal */
    const FIELDS = [
        'boolean_value' => ['booleanValue', 'bool', false, false],
        'text_value' => ['textValue', 'string', false, false],
        'selected_options' => ['selectedOptions', \MindVoice\Sdk\Model\SelectedOptions::class, false, false],
    ];
}
