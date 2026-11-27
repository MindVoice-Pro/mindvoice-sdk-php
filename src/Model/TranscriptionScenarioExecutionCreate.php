<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Запрос пакетного запуска сценария транскрибации.
 *
 * @property-read list<string>|null $recordingIds
 * @property-read string|null $idempotencyKey
 */
final class TranscriptionScenarioExecutionCreate extends Model
{
    /** @internal */
    const FIELDS = [
        'recording_ids' => ['recordingIds', ['list', 'string'], false, false],
        'idempotency_key' => ['idempotencyKey', 'string', false, false],
    ];
}
