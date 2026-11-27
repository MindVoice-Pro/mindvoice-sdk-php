<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Выбранная модель для TranscriptionRunItem.
 *
 * @property-read string $transcriptionScenarioId
 * @property-read string|null $scenarioName
 * @property-read string|null $displayName
 */
final class TranscriptionRunItemModel extends Model
{
    /** @internal */
    const FIELDS = [
        'transcription_scenario_id' => ['transcriptionScenarioId', 'string', true, false],
        'scenario_name' => ['scenarioName', 'string', false, false],
        'display_name' => ['displayName', 'string', false, false],
    ];
}
