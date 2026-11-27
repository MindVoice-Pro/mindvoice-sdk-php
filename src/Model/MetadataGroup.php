<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Группа условий метаданных; максимум 5 уровней, 100 условий и 200
 * узлов.
 *
 * @property-read string|null $logic
 * @property-read list<MetadataFilter|MetadataGroup> $conditions
 */
final class MetadataGroup extends Model
{
    /** @internal */
    const FIELDS = [
        'logic' => ['logic', 'string', false, false],
        'conditions' => ['conditions', ['list', ['union', [\MindVoice\Sdk\Model\MetadataFilter::class, \MindVoice\Sdk\Model\MetadataGroup::class]]], true, false],
    ];
}
