<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Сведения об ошибке для AnalysisRunDetail.
 *
 * @property-read string|null $code
 * @property-read string|null $message
 */
final class AnalysisRunDetailError extends Model
{
    /** @internal */
    const FIELDS = [
        'code' => ['code', 'string', false, false],
        'message' => ['message', 'string', false, false],
    ];
}
