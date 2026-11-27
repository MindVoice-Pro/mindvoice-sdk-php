<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение MetadataFilter.
 *
 * @property-read string $field
 * @property-read string $operator
 * @property-read mixed $value
 * @property-read bool|null $includeEmpty
 */
final class MetadataFilter extends Model
{
    /** @internal */
    const FIELDS = [
        'field' => ['field', 'string', true, false],
        'operator' => ['operator', 'string', true, false],
        'value' => ['value', 'mixed', false, true],
        'include_empty' => ['includeEmpty', 'bool', false, false],
    ];
}
