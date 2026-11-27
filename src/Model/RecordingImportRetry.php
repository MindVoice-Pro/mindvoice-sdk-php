<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Запрос повторного импорта с необязательной заменой
 * истёкшей ссылки.
 *
 * @property-read string|null $url
 * @property-read bool|null $checkDuplicates
 */
final class RecordingImportRetry extends Model
{
    /** @internal */
    const FIELDS = [
        'url' => ['url', 'string', false, false],
        'check_duplicates' => ['checkDuplicates', 'bool', false, false],
    ];
}
