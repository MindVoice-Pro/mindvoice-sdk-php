<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Свойства файла для RecordingItem.
 *
 * @property-read string $filename
 * @property-read string|null $mimeType
 * @property-read string|null $sizeBytes
 * @property-read string|null $checksum
 * @property-read string $checksumAlgorithm
 * @property-read string|null $downloadUrl
 */
final class RecordingItemFile extends Model
{
    /** @internal */
    const FIELDS = [
        'filename' => ['filename', 'string', true, false],
        'mime_type' => ['mimeType', 'string', false, false],
        'size_bytes' => ['sizeBytes', 'string', false, false],
        'checksum' => ['checksum', 'string', false, false],
        'checksum_algorithm' => ['checksumAlgorithm', 'string', true, false],
        'download_url' => ['downloadUrl', 'string', false, false],
    ];
}
