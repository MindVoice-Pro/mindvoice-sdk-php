<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Параметры выполнения для AnalysisRunDetail.
 *
 * @property-read string $status
 * @property-read bool|null $isTest
 * @property-read string $createdAt
 * @property-read string|null $startedAt
 * @property-read string|null $finishedAt
 * @property-read string|null $failedAt
 * @property-read string|null $cancelledAt
 * @property-read string|null $cancelledBy
 * @property-read string|null $worker
 * @property-read int|null $processingDurationSec
 */
final class AnalysisRunDetailExecution extends Model
{
    /** @internal */
    const FIELDS = [
        'status' => ['status', 'string', true, false],
        'is_test' => ['isTest', 'bool', false, false],
        'created_at' => ['createdAt', 'string', true, false],
        'started_at' => ['startedAt', 'string', false, false],
        'finished_at' => ['finishedAt', 'string', false, false],
        'failed_at' => ['failedAt', 'string', false, false],
        'cancelled_at' => ['cancelledAt', 'string', false, false],
        'cancelled_by' => ['cancelledBy', 'string', false, false],
        'worker' => ['worker', 'string', false, false],
        'processing_duration_sec' => ['processingDurationSec', 'int', false, false],
    ];
}
