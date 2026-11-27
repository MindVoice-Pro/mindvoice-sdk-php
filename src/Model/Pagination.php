<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Метаданные страницы. Возможности пагинации конкретного
 * пути не расширяются автоматически.
 *
 * @property-read int $pageSize
 * @property-read int|null $offset
 * @property-read int|null $totalCount
 */
final class Pagination extends Model
{
    /** @internal */
    const FIELDS = [
        'page_size' => ['pageSize', 'int', true, false],
        'offset' => ['offset', 'int', false, false],
        'total_count' => ['totalCount', 'int', false, false],
    ];
}
