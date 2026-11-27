<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение app__analysis__schemas__ScenarioExecutionItemResponse.
 *
 * @property-read AnalysisScenarioExecutionItem $execution
 */
final class AnalysisScenarioExecutionItemResponse extends Model
{
    /** @internal */
    const FIELDS = [
        'execution' => ['execution', \MindVoice\Sdk\Model\AnalysisScenarioExecutionItem::class, true, false],
    ];
}
