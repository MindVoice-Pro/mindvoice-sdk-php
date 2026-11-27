<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Сохранённая стоимость транскрибации до скидок.
 *
 * @property-read string $cost
 */
final class TranscriptionRunItemBilling extends Model
{
    /** @internal */
    const FIELDS = [
        'cost' => ['cost', 'string', true, false],
    ];
}
