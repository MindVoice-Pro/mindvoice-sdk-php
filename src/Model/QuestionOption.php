<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение QuestionOption.
 *
 * @property-read string $key
 * @property-read string $label
 * @property-read bool|null $isCritical
 */
final class QuestionOption extends Model
{
    /** @internal */
    const FIELDS = [
        'key' => ['key', 'string', true, false],
        'label' => ['label', 'string', true, false],
        'is_critical' => ['isCritical', 'bool', false, false],
    ];
}
