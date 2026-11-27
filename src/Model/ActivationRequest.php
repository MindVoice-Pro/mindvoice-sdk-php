<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Запрос изменения активности сценария.
 *
 * @property-read bool $active
 */
final class ActivationRequest extends Model
{
    /** @internal */
    const FIELDS = [
        'active' => ['active', 'bool', true, false],
    ];
}
