<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Параметры выполнения для TranscriptionRunItem.
 *
 * @property-read string|null $jobId
 * @property-read string $status
 * @property-read string $createdAt
 * @property-read string|null $startedAt
 * @property-read string|null $finishedAt
 * @property-read string|null $failedAt
 * @property-read string|null $cancelledAt
 * @property-read string|null $cancelledBy
 * @property-read string|null $worker
 */
final class TranscriptionRunItemExecution extends Model
{
    /** @internal */
    const FIELDS = [
        'job_id' => ['jobId', 'string', false, false],
        'status' => ['status', 'string', true, false],
        'created_at' => ['createdAt', 'string', true, false],
        'started_at' => ['startedAt', 'string', false, false],
        'finished_at' => ['finishedAt', 'string', false, false],
        'failed_at' => ['failedAt', 'string', false, false],
        'cancelled_at' => ['cancelledAt', 'string', false, false],
        'cancelled_by' => ['cancelledBy', 'string', false, false],
        'worker' => ['worker', 'string', false, false],
    ];
}
