<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Публичное представление сценария транскрибации.
 *
 * @property-read string $id
 * @property-read string $name
 * @property-read string|null $description
 * @property-read string $status
 * @property-read bool $active
 * @property-read TranscriptionScenarioItemRecognition $recognition
 * @property-read TranscriptionScenarioItemSummaryGeneration $summaryGeneration
 * @property-read TranscriptionScenarioItemTrigger $trigger
 * @property-read TranscriptionScenarioItemAudit $audit
 * @property-read TranscriptionScenarioItemStatistics $statistics
 */
final class TranscriptionScenarioItem extends Model
{
    /** @internal */
    const FIELDS = [
        'id' => ['id', 'string', true, false],
        'name' => ['name', 'string', true, false],
        'description' => ['description', 'string', false, false],
        'status' => ['status', 'string', true, false],
        'active' => ['active', 'bool', true, false],
        'recognition' => ['recognition', \MindVoice\Sdk\Model\TranscriptionScenarioItemRecognition::class, true, false],
        'summary_generation' => ['summaryGeneration', \MindVoice\Sdk\Model\TranscriptionScenarioItemSummaryGeneration::class, true, false],
        'trigger' => ['trigger', \MindVoice\Sdk\Model\TranscriptionScenarioItemTrigger::class, true, false],
        'audit' => ['audit', \MindVoice\Sdk\Model\TranscriptionScenarioItemAudit::class, true, false],
        'statistics' => ['statistics', \MindVoice\Sdk\Model\TranscriptionScenarioItemStatistics::class, true, false],
    ];
}
