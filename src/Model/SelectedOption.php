<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Выбранный вариант ответа из исторического снимка сценария.
 *
 * @property-read string $key
 * @property-read string|null $label
 * @property-read bool|null $isCritical
 */
final class SelectedOption extends Model
{
    /** @internal */
    const FIELDS = [
        'key' => ['key', 'string', true, false],
        'label' => ['label', 'string', false, false],
        'is_critical' => ['isCritical', 'bool', false, false],
    ];
}
