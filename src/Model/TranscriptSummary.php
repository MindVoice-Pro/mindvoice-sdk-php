<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение TranscriptSummary.
 *
 * @property-read string $status
 * @property-read string|null $text
 * @property-read SummaryDetail|null $detail
 */
final class TranscriptSummary extends Model
{
    /** @internal */
    const FIELDS = [
        'status' => ['status', 'string', true, false],
        'text' => ['text', 'string', false, false],
        'detail' => ['detail', \MindVoice\Sdk\Model\SummaryDetail::class, false, false],
    ];
}
