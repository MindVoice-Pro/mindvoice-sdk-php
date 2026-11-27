<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение app__transcription__schemas__ScenarioExecutionItemResponse.
 *
 * @property-read TranscriptionScenarioExecutionItem $execution
 */
final class TranscriptionScenarioExecutionItemResponse extends Model
{
    /** @internal */
    const FIELDS = [
        'execution' => ['execution', \MindVoice\Sdk\Model\TranscriptionScenarioExecutionItem::class, true, false],
    ];
}
