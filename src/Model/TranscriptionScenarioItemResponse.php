<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение TranscriptionScenarioItemResponse.
 *
 * @property-read TranscriptionScenarioItem $scenario
 */
final class TranscriptionScenarioItemResponse extends Model
{
    /** @internal */
    const FIELDS = [
        'scenario' => ['scenario', \MindVoice\Sdk\Model\TranscriptionScenarioItem::class, true, false],
    ];
}
