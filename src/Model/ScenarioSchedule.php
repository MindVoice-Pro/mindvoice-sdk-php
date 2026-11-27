<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение ScenarioSchedule.
 *
 * @property-read string $frequency
 * @property-read string|null $time
 * @property-read int|null $weekday
 * @property-read string $timezone
 */
final class ScenarioSchedule extends Model
{
    /** @internal */
    const FIELDS = [
        'frequency' => ['frequency', 'string', true, false],
        'time' => ['time', 'string', false, false],
        'weekday' => ['weekday', 'int', false, false],
        'timezone' => ['timezone', 'string', true, false],
    ];
}
