<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Свойства файла для RecordingImport.
 *
 * @property-read string $url
 * @property-read string|null $filename
 */
final class RecordingImportFile extends Model
{
    /** @internal */
    const FIELDS = [
        'url' => ['url', 'string', true, false],
        'filename' => ['filename', 'string', false, false],
    ];
}
