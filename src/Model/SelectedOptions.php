<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Выбранные варианты в порядке ответа модели, включая пустой
 * выбор.
 *
 * @property-read list<SelectedOption> $options
 */
final class SelectedOptions extends Model
{
    /** @internal */
    const FIELDS = [
        'options' => ['options', ['list', \MindVoice\Sdk\Model\SelectedOption::class], true, false],
    ];
}
