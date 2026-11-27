<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение AnalysisResultItemResponse.
 *
 * @property-read AnalysisResultItem $result
 */
final class AnalysisResultItemResponse extends Model
{
    /** @internal */
    const FIELDS = [
        'result' => ['result', \MindVoice\Sdk\Model\AnalysisResultItem::class, true, false],
    ];
}
