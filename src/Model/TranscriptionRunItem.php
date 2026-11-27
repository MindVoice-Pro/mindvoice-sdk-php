<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Публичное представление запуска транскрибации.
 *
 * @property-read string $id
 * @property-read TranscriptionRunItemSource $source
 * @property-read TranscriptionRunItemExecution $execution
 * @property-read TranscriptionRunItemRetry|null $retry
 * @property-read TranscriptionRunItemError|null $error
 * @property-read TranscriptionRunItemModel $model
 * @property-read TranscriptionRunItemResult|null $result
 * @property-read TranscriptionRunItemStatistics|null $statistics
 * @property-read TranscriptionRunItemBilling $billing
 */
final class TranscriptionRunItem extends Model
{
    /** @internal */
    const FIELDS = [
        'id' => ['id', 'string', true, false],
        'source' => ['source', \MindVoice\Sdk\Model\TranscriptionRunItemSource::class, true, false],
        'execution' => ['execution', \MindVoice\Sdk\Model\TranscriptionRunItemExecution::class, true, false],
        'retry' => ['retry', \MindVoice\Sdk\Model\TranscriptionRunItemRetry::class, false, false],
        'error' => ['error', \MindVoice\Sdk\Model\TranscriptionRunItemError::class, false, false],
        'model' => ['model', \MindVoice\Sdk\Model\TranscriptionRunItemModel::class, true, false],
        'result' => ['result', \MindVoice\Sdk\Model\TranscriptionRunItemResult::class, false, false],
        'statistics' => ['statistics', \MindVoice\Sdk\Model\TranscriptionRunItemStatistics::class, false, false],
        'billing' => ['billing', \MindVoice\Sdk\Model\TranscriptionRunItemBilling::class, true, false],
    ];
}
