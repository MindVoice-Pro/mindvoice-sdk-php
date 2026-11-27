<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Описывает фильтры источника анализа в именах параметров
 * списка транскрибаций.
 *
 * @property-read string|null $type
 * @property-read string|null $transcriptionScenarioId
 * @property-read string|null $sourceScenarioId
 * @property-read string|null $transcriptionId
 * @property-read string|null $jobId
 * @property-read string|null $fileId
 * @property-read string|null $search
 * @property-read list<string>|null $status
 * @property-read list<string>|null $scenario
 * @property-read list<string>|null $model
 * @property-read bool|null $hasSummary
 * @property-read bool|null $hasDiarization
 * @property-read int|null $wordsFrom
 * @property-read int|null $wordsTo
 * @property-read string|null $createdFrom
 * @property-read string|null $createdTo
 * @property-read list<MetadataFilter>|null $metadataFilters
 * @property-read string|null $metadataLogic
 * @property-read MetadataGroup|null $metadataGroup
 * @property-read bool|null $onlyWithoutAnalysis
 */
final class AnalysisSourceFilter extends Model
{
    /** @internal */
    const FIELDS = [
        'type' => ['type', 'string', false, false],
        'transcription_scenario_id' => ['transcriptionScenarioId', 'string', false, false],
        'source_scenario_id' => ['sourceScenarioId', 'string', false, false],
        'transcription_id' => ['transcriptionId', 'string', false, false],
        'job_id' => ['jobId', 'string', false, false],
        'file_id' => ['fileId', 'string', false, false],
        'search' => ['search', 'string', false, false],
        'status' => ['status', ['list', 'string'], false, false],
        'scenario' => ['scenario', ['list', 'string'], false, false],
        'model' => ['model', ['list', 'string'], false, false],
        'has_summary' => ['hasSummary', 'bool', false, false],
        'has_diarization' => ['hasDiarization', 'bool', false, false],
        'words_from' => ['wordsFrom', 'int', false, false],
        'words_to' => ['wordsTo', 'int', false, false],
        'created_from' => ['createdFrom', 'string', false, false],
        'created_to' => ['createdTo', 'string', false, false],
        'metadata_filters' => ['metadataFilters', ['list', \MindVoice\Sdk\Model\MetadataFilter::class], false, false],
        'metadata_logic' => ['metadataLogic', 'string', false, false],
        'metadata_group' => ['metadataGroup', \MindVoice\Sdk\Model\MetadataGroup::class, false, false],
        'only_without_analysis' => ['onlyWithoutAnalysis', 'bool', false, false],
    ];
}
