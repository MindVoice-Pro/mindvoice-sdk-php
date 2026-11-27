<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Полная карточка анализа с неизменным ID запуска и
 * необязательным результатом.
 *
 * @property-read string $id
 * @property-read AnalysisRunDetailSource $source
 * @property-read AnalysisRunDetailExecution $execution
 * @property-read AnalysisRunDetailRetry $retry
 * @property-read AnalysisRunDetailError|null $error
 * @property-read AnalysisRunDetailModel $model
 * @property-read AnalysisRunDetailBilling $billing
 * @property-read AnalysisRunDetailResult $result
 * @property-read AnalysisRunDetailStatistics $statistics
 */
final class AnalysisRunDetail extends Model
{
    /** @internal */
    const FIELDS = [
        'id' => ['id', 'string', true, false],
        'source' => ['source', \MindVoice\Sdk\Model\AnalysisRunDetailSource::class, true, false],
        'execution' => ['execution', \MindVoice\Sdk\Model\AnalysisRunDetailExecution::class, true, false],
        'retry' => ['retry', \MindVoice\Sdk\Model\AnalysisRunDetailRetry::class, true, false],
        'error' => ['error', \MindVoice\Sdk\Model\AnalysisRunDetailError::class, false, false],
        'model' => ['model', \MindVoice\Sdk\Model\AnalysisRunDetailModel::class, true, false],
        'billing' => ['billing', \MindVoice\Sdk\Model\AnalysisRunDetailBilling::class, true, false],
        'result' => ['result', \MindVoice\Sdk\Model\AnalysisRunDetailResult::class, true, false],
        'statistics' => ['statistics', \MindVoice\Sdk\Model\AnalysisRunDetailStatistics::class, true, false],
    ];
}
