<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Условия запуска для TranscriptionScenarioItem.
 *
 * @property-read string $triggerType
 * @property-read ScenarioSchedule|null $schedule
 * @property-read RecordingFilter $fileFilter
 */
final class TranscriptionScenarioItemTrigger extends Model
{
    /** @internal */
    const FIELDS = [
        'trigger_type' => ['triggerType', 'string', true, false],
        'schedule' => ['schedule', \MindVoice\Sdk\Model\ScenarioSchedule::class, false, false],
        'file_filter' => ['fileFilter', \MindVoice\Sdk\Model\RecordingFilter::class, true, false],
    ];
}
