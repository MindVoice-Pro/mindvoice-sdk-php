<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение AnalysisRunDetailResponse.
 *
 * @property-read AnalysisRunDetail $run
 */
final class AnalysisRunDetailResponse extends Model
{
    /** @internal */
    const FIELDS = [
        'run' => ['run', \MindVoice\Sdk\Model\AnalysisRunDetail::class, true, false],
    ];
}
