<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Группа одного сценария; код сохраняется при перестановке и
 * клонировании.
 *
 * @property-read string $id
 * @property-read string $code
 * @property-read string $title
 * @property-read int|null $weight
 */
final class AnalysisCriterionGroup extends Model
{
    /** @internal */
    const FIELDS = [
        'id' => ['id', 'string', true, false],
        'code' => ['code', 'string', true, false],
        'title' => ['title', 'string', true, false],
        'weight' => ['weight', 'int', false, false],
    ];
}
