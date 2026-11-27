<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Публичное представление запуска анализа.
 *
 * @property-read string $id
 * @property-read AnalysisRunItemSource $source
 * @property-read AnalysisRunItemExecution $execution
 * @property-read AnalysisRunItemRetry $retry
 * @property-read AnalysisRunItemError|null $error
 * @property-read AnalysisRunItemModel $model
 * @property-read AnalysisRunItemBilling $billing
 */
final class AnalysisRunItem extends Model
{
    /** @internal */
    const FIELDS = [
        'id' => ['id', 'string', true, false],
        'source' => ['source', \MindVoice\Sdk\Model\AnalysisRunItemSource::class, true, false],
        'execution' => ['execution', \MindVoice\Sdk\Model\AnalysisRunItemExecution::class, true, false],
        'retry' => ['retry', \MindVoice\Sdk\Model\AnalysisRunItemRetry::class, true, false],
        'error' => ['error', \MindVoice\Sdk\Model\AnalysisRunItemError::class, false, false],
        'model' => ['model', \MindVoice\Sdk\Model\AnalysisRunItemModel::class, true, false],
        'billing' => ['billing', \MindVoice\Sdk\Model\AnalysisRunItemBilling::class, true, false],
    ];
}
