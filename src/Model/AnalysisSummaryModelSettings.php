<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Параметры сэмплирования сводки AI-анализа.
 *
 * @property-read float|null $temperature
 * @property-read float|null $topP
 */
final class AnalysisSummaryModelSettings extends Model
{
    /** @internal */
    const FIELDS = [
        'temperature' => ['temperature', 'float', false, false],
        'top_p' => ['topP', 'float', false, false],
    ];
}
