<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение AnalysisScenarioItemResponse.
 *
 * @property-read AnalysisScenarioItem $scenario
 */
final class AnalysisScenarioItemResponse extends Model
{
    /** @internal */
    const FIELDS = [
        'scenario' => ['scenario', \MindVoice\Sdk\Model\AnalysisScenarioItem::class, true, false],
    ];
}
