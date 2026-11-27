<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение AnalysisRunItemResponse.
 *
 * @property-read AnalysisRunItem $run
 */
final class AnalysisRunItemResponse extends Model
{
    /** @internal */
    const FIELDS = [
        'run' => ['run', \MindVoice\Sdk\Model\AnalysisRunItem::class, true, false],
    ];
}
