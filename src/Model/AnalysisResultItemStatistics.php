<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Счётчики результата анализа по историческим правилам
 * критериев.
 *
 * @property-read int $criticalCount
 */
final class AnalysisResultItemStatistics extends Model
{
    /** @internal */
    const FIELDS = [
        'critical_count' => ['criticalCount', 'int', true, false],
    ];
}
