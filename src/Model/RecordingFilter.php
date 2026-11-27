<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение RecordingFilter.
 *
 * @property-read string|null $uploadedFrom
 * @property-read string|null $uploadedTo
 * @property-read list<string>|null $status
 * @property-read list<string>|null $source
 * @property-read string|null $search
 * @property-read string|null $fileId
 * @property-read int|null $durationFrom
 * @property-read int|null $durationTo
 * @property-read float|null $sizeFrom
 * @property-read float|null $sizeTo
 * @property-read float|null $silenceRatioFrom
 * @property-read float|null $silenceRatioTo
 * @property-read list<MetadataFilter>|null $metadataFilters
 * @property-read bool|null $onlyWithoutTranscription
 * @property-read string|null $dedupPolicy
 * @property-read string|null $metadataLogic
 * @property-read MetadataGroup|null $metadataGroup
 */
final class RecordingFilter extends Model
{
    /** @internal */
    const FIELDS = [
        'uploaded_from' => ['uploadedFrom', 'string', false, false],
        'uploaded_to' => ['uploadedTo', 'string', false, false],
        'status' => ['status', ['list', 'string'], false, false],
        'source' => ['source', ['list', 'string'], false, false],
        'search' => ['search', 'string', false, false],
        'file_id' => ['fileId', 'string', false, false],
        'duration_from' => ['durationFrom', 'int', false, false],
        'duration_to' => ['durationTo', 'int', false, false],
        'size_from' => ['sizeFrom', 'float', false, false],
        'size_to' => ['sizeTo', 'float', false, false],
        'silence_ratio_from' => ['silenceRatioFrom', 'float', false, false],
        'silence_ratio_to' => ['silenceRatioTo', 'float', false, false],
        'metadata_filters' => ['metadataFilters', ['list', \MindVoice\Sdk\Model\MetadataFilter::class], false, false],
        'only_without_transcription' => ['onlyWithoutTranscription', 'bool', false, false],
        'dedup_policy' => ['dedupPolicy', 'string', false, false],
        'metadata_logic' => ['metadataLogic', 'string', false, false],
        'metadata_group' => ['metadataGroup', \MindVoice\Sdk\Model\MetadataGroup::class, false, false],
    ];
}
