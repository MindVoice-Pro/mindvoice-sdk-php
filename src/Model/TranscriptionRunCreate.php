<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Запрос запуска транскрибации.
 *
 * @property-read string $transcriptionScenarioId
 */
final class TranscriptionRunCreate extends Model
{
    /** @internal */
    const FIELDS = [
        'transcription_scenario_id' => ['transcriptionScenarioId', 'string', true, false],
    ];
}
