<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение ModelSettings.
 *
 * @property-read float|null $temperature
 * @property-read float|null $topP
 * @property-read \stdClass|null $providerOptions
 */
final class ModelSettings extends Model
{
    /** @internal */
    const FIELDS = [
        'temperature' => ['temperature', 'float', false, false],
        'top_p' => ['topP', 'float', false, false],
        'provider_options' => ['providerOptions', 'stdClass', false, false],
    ];
}
