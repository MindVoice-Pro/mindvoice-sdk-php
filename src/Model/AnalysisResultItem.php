<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Публичное представление результата анализа.
 *
 * @property-read string $id
 * @property-read string $createdAt
 * @property-read AnalysisResultItemSource $source
 * @property-read AnalysisResultItemResult $result
 * @property-read AnalysisResultItemUsage $usage
 * @property-read AnalysisResultItemStatistics $statistics
 * @property-read RecordingItem|null $recording
 */
final class AnalysisResultItem extends Model
{
    /** @internal */
    const FIELDS = [
        'id' => ['id', 'string', true, false],
        'created_at' => ['createdAt', 'string', true, false],
        'source' => ['source', \MindVoice\Sdk\Model\AnalysisResultItemSource::class, true, false],
        'result' => ['result', \MindVoice\Sdk\Model\AnalysisResultItemResult::class, true, false],
        'usage' => ['usage', \MindVoice\Sdk\Model\AnalysisResultItemUsage::class, true, false],
        'statistics' => ['statistics', \MindVoice\Sdk\Model\AnalysisResultItemStatistics::class, true, false],
        'recording' => ['recording', \MindVoice\Sdk\Model\RecordingItem::class, false, false],
    ];
}
