<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Параметры выполнения для app__analysis__schemas__ScenarioExecutionItem.
 *
 * @property-read string $status
 * @property-read string $createdAt
 * @property-read string|null $startedAt
 * @property-read string|null $finishedAt
 * @property-read string|null $preparationStatus
 * @property-read string|null $preparationErrorCode
 */
final class AnalysisScenarioExecutionItemExecution extends Model
{
    /** @internal */
    const FIELDS = [
        'status' => ['status', 'string', true, false],
        'created_at' => ['createdAt', 'string', true, false],
        'started_at' => ['startedAt', 'string', false, false],
        'finished_at' => ['finishedAt', 'string', false, false],
        'preparation_status' => ['preparationStatus', 'string', false, false],
        'preparation_error_code' => ['preparationErrorCode', 'string', false, false],
    ];
}
