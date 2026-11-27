<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Generated;

use MindVoice\Sdk\Model;
use MindVoice\Sdk\Response;
use MindVoice\Sdk\UploadRecordingInput;

/** Операции публичного API MindVoice. */
trait Operations
{
    /**
     * Возвращает список workspace текущего principal.
     *
     * @return Model\WorkspaceList
     */
    public function listWorkspaces()
    {
        return $this->requestJson(
            'GET',
            '/v1/workspaces',
            Model\WorkspaceList::class
        );
    }

    /**
     * Возвращает обзор workspace после проверки доступа.
     *
     * @param string $workspaceId
     * @return Model\WorkspaceOverview
     */
    public function getWorkspaceOverview($workspaceId)
    {
        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/overview', ['workspace_id' => [$workspaceId, 'string']]),
            Model\WorkspaceOverview::class
        );
    }

    /**
     * Загружает аудиофайл с выбранным сроком хранения после
     * проверки доступа к данным.
     *
     * @param string $workspaceId
     * @param UploadRecordingInput|array<string, mixed> $input
     * @return Model\RecordingItemResponse
     */
    public function uploadRecording($workspaceId, $input)
    {
        $upload = $input instanceof UploadRecordingInput ? $input : new UploadRecordingInput($input);
        $body = $upload->multipart();

        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/recordings', ['workspace_id' => [$workspaceId, 'string']]),
            Model\RecordingItemResponse::class,
            [],
            [],
            $body
        );
    }

    /**
     * Возвращает список записей с фильтрами.
     *
     * @param string $workspaceId
     * @param array{
     *     pageSize?: int,
     *     offset?: int,
     *     uploadedFrom?: string,
     *     uploadedTo?: string,
     *     recordedFrom?: string,
     *     recordedTo?: string,
     *     status?: list<string>,
     *     source?: list<string>,
     *     search?: string,
     *     fileId?: string,
     *     durationFrom?: int,
     *     durationTo?: int,
     *     sizeFrom?: float,
     *     sizeTo?: float,
     *     silenceRatioFrom?: float,
     *     silenceRatioTo?: float,
     *     averageLoudnessFrom?: float,
     *     averageLoudnessTo?: float,
     *     peakFrom?: float,
     *     peakTo?: float,
     *     bitrateFrom?: int,
     *     bitrateTo?: int,
     *     clipping?: string,
     *     channels?: list<string>,
     *     audioMissing?: list<string>,
     *     transcriptionsCountFrom?: int,
     *     transcriptionsCountTo?: int,
     *     analysesCountFrom?: int,
     *     analysesCountTo?: int,
     *     sortBy?: string,
     *     sortDirection?: string,
     *     metadataFilters?: list<Model\MetadataFilter|array<string, mixed>>,
     *     metadataLogic?: string,
     *     metadataGroup?: Model\MetadataGroup|array<string, mixed>,
     *     annulmentStatus?: string,
     *     onlyWithoutTranscription?: bool,
     * } $options
     * @return Model\RecordingList
     */
    public function listRecordings($workspaceId, $options = [])
    {
        list($query, $headers) = $this->parameters($options, [
            'pageSize' => ['page_size', 'query', 'int', false, false],
            'offset' => ['offset', 'query', 'int', false, false],
            'uploadedFrom' => ['uploaded_from', 'query', 'string', false, false],
            'uploadedTo' => ['uploaded_to', 'query', 'string', false, false],
            'recordedFrom' => ['recorded_from', 'query', 'string', false, false],
            'recordedTo' => ['recorded_to', 'query', 'string', false, false],
            'status' => ['status', 'query', ['list', 'string'], false, false],
            'source' => ['source', 'query', ['list', 'string'], false, false],
            'search' => ['search', 'query', 'string', false, false],
            'fileId' => ['file_id', 'query', 'string', false, false],
            'durationFrom' => ['duration_from', 'query', 'int', false, false],
            'durationTo' => ['duration_to', 'query', 'int', false, false],
            'sizeFrom' => ['size_from', 'query', 'float', false, false],
            'sizeTo' => ['size_to', 'query', 'float', false, false],
            'silenceRatioFrom' => ['silence_ratio_from', 'query', 'float', false, false],
            'silenceRatioTo' => ['silence_ratio_to', 'query', 'float', false, false],
            'averageLoudnessFrom' => ['average_loudness_from', 'query', 'float', false, false],
            'averageLoudnessTo' => ['average_loudness_to', 'query', 'float', false, false],
            'peakFrom' => ['peak_from', 'query', 'float', false, false],
            'peakTo' => ['peak_to', 'query', 'float', false, false],
            'bitrateFrom' => ['bitrate_from', 'query', 'int', false, false],
            'bitrateTo' => ['bitrate_to', 'query', 'int', false, false],
            'clipping' => ['clipping', 'query', 'string', false, false],
            'channels' => ['channels', 'query', ['list', 'string'], false, false],
            'audioMissing' => ['audio_missing', 'query', ['list', 'string'], false, false],
            'transcriptionsCountFrom' => ['transcriptions_count_from', 'query', 'int', false, false],
            'transcriptionsCountTo' => ['transcriptions_count_to', 'query', 'int', false, false],
            'analysesCountFrom' => ['analyses_count_from', 'query', 'int', false, false],
            'analysesCountTo' => ['analyses_count_to', 'query', 'int', false, false],
            'sortBy' => ['sort_by', 'query', 'string', false, false],
            'sortDirection' => ['sort_direction', 'query', 'string', false, false],
            'metadataFilters' => ['metadata_filters', 'query', ['list', \MindVoice\Sdk\Model\MetadataFilter::class], false, true],
            'metadataLogic' => ['metadata_logic', 'query', 'string', false, false],
            'metadataGroup' => ['metadata_group', 'query', \MindVoice\Sdk\Model\MetadataGroup::class, false, true],
            'annulmentStatus' => ['annulment_status', 'query', 'string', false, false],
            'onlyWithoutTranscription' => ['only_without_transcription', 'query', 'bool', false, false],
        ]);

        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/recordings', ['workspace_id' => [$workspaceId, 'string']]),
            Model\RecordingList::class,
            $query,
            $headers
        );
    }

    /**
     * Создаёт карточку записи и ставит скачивание прямой
     * ссылки в очередь.
     *
     * @param string $workspaceId
     * @param Model\RecordingImport|array<string, mixed> $input
     * @return Model\RecordingItemResponse
     */
    public function importRecording($workspaceId, $input)
    {
        $body = Model\RecordingImport::fromInput($input, 'input');

        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/recordings/import', ['workspace_id' => [$workspaceId, 'string']]),
            Model\RecordingItemResponse::class,
            [],
            [],
            $body
        );
    }

    /**
     * Повторяет неудавшийся импорт с сохранением ID и
     * необязательной заменой ссылки.
     *
     * @param string $workspaceId
     * @param string $recordingId
     * @param Model\RecordingImportRetry|array<string, mixed> $input
     * @return Model\RecordingItemResponse
     */
    public function retryRecordingImport($workspaceId, $recordingId, $input)
    {
        $body = Model\RecordingImportRetry::fromInput($input, 'input');

        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/recordings/{recording_id}/import/retry', ['workspace_id' => [$workspaceId, 'string'], 'recording_id' => [$recordingId, 'string']]),
            Model\RecordingItemResponse::class,
            [],
            [],
            $body
        );
    }

    /**
     * Возвращает одну аудиозапись.
     *
     * @param string $workspaceId
     * @param string $recordingId
     * @return Model\RecordingItemResponse
     */
    public function getRecording($workspaceId, $recordingId)
    {
        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/recordings/{recording_id}', ['workspace_id' => [$workspaceId, 'string'], 'recording_id' => [$recordingId, 'string']]),
            Model\RecordingItemResponse::class
        );
    }

    /**
     * Обновляет имя и metadata аудиозаписи без изменения исходного
     * объекта storage.
     *
     * @param string $workspaceId
     * @param string $recordingId
     * @param Model\RecordingUpdate|array<string, mixed> $input
     * @return Model\RecordingItemResponse
     */
    public function updateRecording($workspaceId, $recordingId, $input)
    {
        $body = Model\RecordingUpdate::fromInput($input, 'input');

        return $this->requestJson(
            'PATCH',
            $this->endpoint('/v1/workspaces/{workspace_id}/recordings/{recording_id}', ['workspace_id' => [$workspaceId, 'string'], 'recording_id' => [$recordingId, 'string']]),
            Model\RecordingItemResponse::class,
            [],
            [],
            $body
        );
    }

    /**
     * Удаляет исходный файл и возвращает сохранённую карточку
     * со статусом deleted.
     *
     * @param string $workspaceId
     * @param string $recordingId
     * @return Model\RecordingItemResponse
     */
    public function deleteRecording($workspaceId, $recordingId)
    {
        return $this->requestJson(
            'DELETE',
            $this->endpoint('/v1/workspaces/{workspace_id}/recordings/{recording_id}', ['workspace_id' => [$workspaceId, 'string'], 'recording_id' => [$recordingId, 'string']]),
            Model\RecordingItemResponse::class
        );
    }

    /**
     * Аннулирует запись после проверки прав, сохраняя карточку
     * и результаты для истории.
     *
     * @param string $workspaceId
     * @param string $recordingId
     * @return Model\RecordingItemResponse
     */
    public function annulRecording($workspaceId, $recordingId)
    {
        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/recordings/{recording_id}/annul', ['workspace_id' => [$workspaceId, 'string'], 'recording_id' => [$recordingId, 'string']]),
            Model\RecordingItemResponse::class
        );
    }

    /**
     * Возвращает исходный аудиофайл через backend proxy.
     *
     * @param string $workspaceId
     * @param string $recordingId
     * @param array{
     *     range?: string,
     *     ifRange?: string,
     * } $options
     * @return Response
     */
    public function downloadRecording($workspaceId, $recordingId, $options = [])
    {
        list($query, $headers) = $this->parameters($options, [
            'range' => ['Range', 'header', 'string', false, false],
            'ifRange' => ['If-Range', 'header', 'string', false, false],
        ]);

        return $this->requestFile(
            $this->endpoint('/v1/workspaces/{workspace_id}/recordings/{recording_id}/download', ['workspace_id' => [$workspaceId, 'string'], 'recording_id' => [$recordingId, 'string']]),
            'application/octet-stream',
            $query,
            $headers
        );
    }

    /**
     * Повторно ставит неудавшийся анализ аудиозаписи в
     * очередь.
     *
     * @param string $workspaceId
     * @param string $recordingId
     * @return Model\RecordingItemResponse
     */
    public function retryRecordingAudioAnalysis($workspaceId, $recordingId)
    {
        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/recordings/{recording_id}/audio-analysis/retry', ['workspace_id' => [$workspaceId, 'string'], 'recording_id' => [$recordingId, 'string']]),
            Model\RecordingItemResponse::class
        );
    }

    /**
     * Возвращает отфильтрованную серверную страницу сценариев
     * с общим количеством.
     *
     * @param string $workspaceId
     * @param array{
     *     pageSize?: int,
     *     offset?: int,
     *     search?: string,
     *     status?: list<string>,
     *     model?: list<string>,
     *     triggerType?: list<string>,
     *     sortBy?: string,
     *     sortDirection?: string,
     * } $options
     * @return Model\TranscriptionScenarioList
     */
    public function listTranscriptionScenarios($workspaceId, $options = [])
    {
        list($query, $headers) = $this->parameters($options, [
            'pageSize' => ['page_size', 'query', 'int', false, false],
            'offset' => ['offset', 'query', 'int', false, false],
            'search' => ['search', 'query', 'string', false, false],
            'status' => ['status', 'query', ['list', 'string'], false, false],
            'model' => ['model', 'query', ['list', 'string'], false, false],
            'triggerType' => ['trigger_type', 'query', ['list', 'string'], false, false],
            'sortBy' => ['sort_by', 'query', 'string', false, false],
            'sortDirection' => ['sort_direction', 'query', 'string', false, false],
        ]);

        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/transcription-scenarios', ['workspace_id' => [$workspaceId, 'string']]),
            Model\TranscriptionScenarioList::class,
            $query,
            $headers
        );
    }

    /**
     * Возвращает один сценарий транскрибации.
     *
     * @param string $workspaceId
     * @param string $scenarioId
     * @return Model\TranscriptionScenarioItemResponse
     */
    public function getTranscriptionScenario($workspaceId, $scenarioId)
    {
        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/transcription-scenarios/{scenario_id}', ['workspace_id' => [$workspaceId, 'string'], 'scenario_id' => [$scenarioId, 'string']]),
            Model\TranscriptionScenarioItemResponse::class
        );
    }

    /**
     * Меняет active у сценария транскрибации.
     *
     * @param string $workspaceId
     * @param string $scenarioId
     * @param Model\ActivationRequest|array<string, mixed> $input
     * @return Model\TranscriptionScenarioItemResponse
     */
    public function setTranscriptionScenarioActive($workspaceId, $scenarioId, $input)
    {
        $body = Model\ActivationRequest::fromInput($input, 'input');

        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/transcription-scenarios/{scenario_id}/activation', ['workspace_id' => [$workspaceId, 'string'], 'scenario_id' => [$scenarioId, 'string']]),
            Model\TranscriptionScenarioItemResponse::class,
            [],
            [],
            $body
        );
    }

    /**
     * Запускает сценарий транскрибации для выбранных или
     * подходящих записей.
     *
     * @param string $workspaceId
     * @param string $scenarioId
     * @param Model\TranscriptionScenarioExecutionCreate|array<string, mixed> $input
     * @return Model\TranscriptionScenarioExecutionItemResponse
     */
    public function startTranscriptionScenarioExecution($workspaceId, $scenarioId, $input)
    {
        $body = Model\TranscriptionScenarioExecutionCreate::fromInput($input, 'input');

        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/transcription-scenarios/{scenario_id}/executions', ['workspace_id' => [$workspaceId, 'string'], 'scenario_id' => [$scenarioId, 'string']]),
            Model\TranscriptionScenarioExecutionItemResponse::class,
            [],
            [],
            $body
        );
    }

    /**
     * Возвращает серверную страницу истории доступного
     * сценария.
     *
     * @param string $workspaceId
     * @param string $scenarioId
     * @param array{
     *     pageSize?: int,
     *     offset?: int,
     *     status?: list<string>,
     * } $options
     * @return Model\TranscriptionScenarioExecutionList
     */
    public function listTranscriptionScenarioExecutions($workspaceId, $scenarioId, $options = [])
    {
        list($query, $headers) = $this->parameters($options, [
            'pageSize' => ['page_size', 'query', 'int', false, false],
            'offset' => ['offset', 'query', 'int', false, false],
            'status' => ['status', 'query', ['list', 'string'], false, false],
        ]);

        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/transcription-scenarios/{scenario_id}/executions', ['workspace_id' => [$workspaceId, 'string'], 'scenario_id' => [$scenarioId, 'string']]),
            Model\TranscriptionScenarioExecutionList::class,
            $query,
            $headers
        );
    }

    /**
     * Создает запуск транскрибации.
     *
     * @param string $workspaceId
     * @param string $recordingId
     * @param Model\TranscriptionRunCreate|array<string, mixed> $input
     * @return Model\TranscriptionRunItemResponse
     */
    public function startTranscriptionRun($workspaceId, $recordingId, $input)
    {
        $body = Model\TranscriptionRunCreate::fromInput($input, 'input');

        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/recordings/{recording_id}/transcription-runs', ['workspace_id' => [$workspaceId, 'string'], 'recording_id' => [$recordingId, 'string']]),
            Model\TranscriptionRunItemResponse::class,
            [],
            [],
            $body
        );
    }

    /**
     * Возвращает полную страницу запусков с серверными
     * фильтрами и счётчиками.
     *
     * @param string $workspaceId
     * @param array{
     *     recordingId?: string,
     *     jobId?: string,
     *     pageSize?: int,
     *     offset?: int,
     *     transcriptionId?: string,
     *     fileId?: string,
     *     search?: string,
     *     status?: list<string>,
     *     scenario?: list<string>,
     *     model?: list<string>,
     *     annulmentStatus?: string,
     *     hasSummary?: bool,
     *     hasDiarization?: bool,
     *     includeRetried?: bool,
     *     wordsFrom?: int,
     *     wordsTo?: int,
     *     createdFrom?: string,
     *     createdTo?: string,
     *     recordedFrom?: string,
     *     recordedTo?: string,
     *     metadataFilters?: list<Model\MetadataFilter|array<string, mixed>>,
     *     metadataLogic?: string,
     *     metadataGroup?: Model\MetadataGroup|array<string, mixed>,
     *     sortBy?: string,
     *     sortDirection?: string,
     * } $options
     * @return Model\TranscriptionRunList
     */
    public function listTranscriptionRuns($workspaceId, $options = [])
    {
        list($query, $headers) = $this->parameters($options, [
            'recordingId' => ['recording_id', 'query', 'string', false, false],
            'jobId' => ['job_id', 'query', 'string', false, false],
            'pageSize' => ['page_size', 'query', 'int', false, false],
            'offset' => ['offset', 'query', 'int', false, false],
            'transcriptionId' => ['transcription_id', 'query', 'string', false, false],
            'fileId' => ['file_id', 'query', 'string', false, false],
            'search' => ['search', 'query', 'string', false, false],
            'status' => ['status', 'query', ['list', 'string'], false, false],
            'scenario' => ['scenario', 'query', ['list', 'string'], false, false],
            'model' => ['model', 'query', ['list', 'string'], false, false],
            'annulmentStatus' => ['annulment_status', 'query', 'string', false, false],
            'hasSummary' => ['has_summary', 'query', 'bool', false, false],
            'hasDiarization' => ['has_diarization', 'query', 'bool', false, false],
            'includeRetried' => ['include_retried', 'query', 'bool', false, false],
            'wordsFrom' => ['words_from', 'query', 'int', false, false],
            'wordsTo' => ['words_to', 'query', 'int', false, false],
            'createdFrom' => ['created_from', 'query', 'string', false, false],
            'createdTo' => ['created_to', 'query', 'string', false, false],
            'recordedFrom' => ['recorded_from', 'query', 'string', false, false],
            'recordedTo' => ['recorded_to', 'query', 'string', false, false],
            'metadataFilters' => ['metadata_filters', 'query', ['list', \MindVoice\Sdk\Model\MetadataFilter::class], false, true],
            'metadataLogic' => ['metadata_logic', 'query', 'string', false, false],
            'metadataGroup' => ['metadata_group', 'query', \MindVoice\Sdk\Model\MetadataGroup::class, false, true],
            'sortBy' => ['sort_by', 'query', 'string', false, false],
            'sortDirection' => ['sort_direction', 'query', 'string', false, false],
        ]);

        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/transcription-runs', ['workspace_id' => [$workspaceId, 'string']]),
            Model\TranscriptionRunList::class,
            $query,
            $headers
        );
    }

    /**
     * Возвращает один запуск транскрибации.
     *
     * @param string $workspaceId
     * @param string $runId
     * @return Model\TranscriptionRunItemResponse
     */
    public function getTranscriptionRun($workspaceId, $runId)
    {
        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/transcription-runs/{run_id}', ['workspace_id' => [$workspaceId, 'string'], 'run_id' => [$runId, 'string']]),
            Model\TranscriptionRunItemResponse::class
        );
    }

    /**
     * Возвращает последний transcript записи.
     *
     * @param string $workspaceId
     * @param string $recordingId
     * @return Model\TranscriptItemResponse
     */
    public function getRecordingTranscript($workspaceId, $recordingId)
    {
        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/recordings/{recording_id}/transcript', ['workspace_id' => [$workspaceId, 'string'], 'recording_id' => [$recordingId, 'string']]),
            Model\TranscriptItemResponse::class
        );
    }

    /**
     * Возвращает текст именно выбранного запуска
     * транскрибации.
     *
     * @param string $workspaceId
     * @param string $runId
     * @return Model\TranscriptItemResponse
     */
    public function getTranscript($workspaceId, $runId)
    {
        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/transcription-runs/{run_id}/transcript', ['workspace_id' => [$workspaceId, 'string'], 'run_id' => [$runId, 'string']]),
            Model\TranscriptItemResponse::class
        );
    }

    /**
     * Скачивает текст выбранного запуска в формате субтитров
     * или TXT.
     *
     * @param string $workspaceId
     * @param string $runId
     * @param array{
     *     format: 'srt'|'vtt'|'txt'|'txt_timestamps',
     * } $options
     * @return Response
     */
    public function exportTranscript($workspaceId, $runId, $options)
    {
        list($query, $headers) = $this->parameters($options, [
            'format' => ['format', 'query', ['enum', ['srt', 'vtt', 'txt', 'txt_timestamps']], true, false],
        ]);

        return $this->requestFile(
            $this->endpoint('/v1/workspaces/{workspace_id}/transcription-runs/{run_id}/transcript/export', ['workspace_id' => [$workspaceId, 'string'], 'run_id' => [$runId, 'string']]),
            'application/x-subrip, text/vtt, text/plain',
            $query,
            $headers
        );
    }

    /**
     * Создаёт новую попытку после ошибки, сохраняя предыдущий
     * запуск.
     *
     * @param string $workspaceId
     * @param string $runId
     * @return Model\TranscriptionRunItemResponse
     */
    public function retryTranscriptionRun($workspaceId, $runId)
    {
        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/transcription-runs/{run_id}/retry', ['workspace_id' => [$workspaceId, 'string'], 'run_id' => [$runId, 'string']]),
            Model\TranscriptionRunItemResponse::class
        );
    }

    /**
     * Отменяет queued/processing запуск с сохранением автора и времени.
     *
     * @param string $workspaceId
     * @param string $runId
     * @return Model\TranscriptionRunItemResponse
     */
    public function cancelTranscriptionRun($workspaceId, $runId)
    {
        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/transcription-runs/{run_id}/cancel', ['workspace_id' => [$workspaceId, 'string'], 'run_id' => [$runId, 'string']]),
            Model\TranscriptionRunItemResponse::class
        );
    }

    /**
     * Аннулирует завершённый или неудачный запуск с проверкой
     * роли, scope и изоляции Workspace.
     *
     * @param string $workspaceId
     * @param string $runId
     * @return Model\TranscriptionRunItemResponse
     */
    public function annulTranscriptionRun($workspaceId, $runId)
    {
        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/transcription-runs/{run_id}/annul', ['workspace_id' => [$workspaceId, 'string'], 'run_id' => [$runId, 'string']]),
            Model\TranscriptionRunItemResponse::class
        );
    }

    /**
     * Ищет существующие критерии для выбора без создания
     * нового вопроса.
     *
     * @param string $workspaceId
     * @param array{
     *     q?: string,
     *     pageSize?: int,
     * } $options
     * @return Model\AnalysisCriterionSearchResponse
     */
    public function searchAnalysisCriteria($workspaceId, $options = [])
    {
        list($query, $headers) = $this->parameters($options, [
            'q' => ['q', 'query', 'string', false, false],
            'pageSize' => ['page_size', 'query', 'int', false, false],
        ]);

        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/analysis-criteria', ['workspace_id' => [$workspaceId, 'string']]),
            Model\AnalysisCriterionSearchResponse::class,
            $query,
            $headers
        );
    }

    /**
     * Возвращает отфильтрованную серверную страницу сценариев
     * с общим количеством.
     *
     * @param string $workspaceId
     * @param array{
     *     pageSize?: int,
     *     offset?: int,
     *     search?: string,
     *     status?: list<string>,
     *     model?: list<string>,
     *     triggerType?: list<string>,
     *     sortBy?: string,
     *     sortDirection?: string,
     * } $options
     * @return Model\AnalysisScenarioList
     */
    public function listAnalysisScenarios($workspaceId, $options = [])
    {
        list($query, $headers) = $this->parameters($options, [
            'pageSize' => ['page_size', 'query', 'int', false, false],
            'offset' => ['offset', 'query', 'int', false, false],
            'search' => ['search', 'query', 'string', false, false],
            'status' => ['status', 'query', ['list', 'string'], false, false],
            'model' => ['model', 'query', ['list', 'string'], false, false],
            'triggerType' => ['trigger_type', 'query', ['list', 'string'], false, false],
            'sortBy' => ['sort_by', 'query', 'string', false, false],
            'sortDirection' => ['sort_direction', 'query', 'string', false, false],
        ]);

        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/analysis-scenarios', ['workspace_id' => [$workspaceId, 'string']]),
            Model\AnalysisScenarioList::class,
            $query,
            $headers
        );
    }

    /**
     * Возвращает один сценарий анализа.
     *
     * @param string $workspaceId
     * @param string $scenarioId
     * @return Model\AnalysisScenarioItemResponse
     */
    public function getAnalysisScenario($workspaceId, $scenarioId)
    {
        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/analysis-scenarios/{scenario_id}', ['workspace_id' => [$workspaceId, 'string'], 'scenario_id' => [$scenarioId, 'string']]),
            Model\AnalysisScenarioItemResponse::class
        );
    }

    /**
     * Меняет active у сценария анализа.
     *
     * @param string $workspaceId
     * @param string $scenarioId
     * @param Model\ActivationRequest|array<string, mixed> $input
     * @return Model\AnalysisScenarioItemResponse
     */
    public function setAnalysisScenarioActive($workspaceId, $scenarioId, $input)
    {
        $body = Model\ActivationRequest::fromInput($input, 'input');

        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/analysis-scenarios/{scenario_id}/activation', ['workspace_id' => [$workspaceId, 'string'], 'scenario_id' => [$scenarioId, 'string']]),
            Model\AnalysisScenarioItemResponse::class,
            [],
            [],
            $body
        );
    }

    /**
     * Запускает сценарий анализа для выбранных или подходящих
     * транскрибаций.
     *
     * @param string $workspaceId
     * @param string $scenarioId
     * @param Model\AnalysisScenarioExecutionCreate|array<string, mixed> $input
     * @return Model\AnalysisScenarioExecutionItemResponse
     */
    public function startAnalysisScenarioExecution($workspaceId, $scenarioId, $input)
    {
        $body = Model\AnalysisScenarioExecutionCreate::fromInput($input, 'input');

        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/analysis-scenarios/{scenario_id}/executions', ['workspace_id' => [$workspaceId, 'string'], 'scenario_id' => [$scenarioId, 'string']]),
            Model\AnalysisScenarioExecutionItemResponse::class,
            [],
            [],
            $body
        );
    }

    /**
     * Возвращает серверную страницу истории доступного
     * сценария.
     *
     * @param string $workspaceId
     * @param string $scenarioId
     * @param array{
     *     pageSize?: int,
     *     offset?: int,
     *     status?: list<string>,
     * } $options
     * @return Model\AnalysisScenarioExecutionList
     */
    public function listAnalysisScenarioExecutions($workspaceId, $scenarioId, $options = [])
    {
        list($query, $headers) = $this->parameters($options, [
            'pageSize' => ['page_size', 'query', 'int', false, false],
            'offset' => ['offset', 'query', 'int', false, false],
            'status' => ['status', 'query', ['list', 'string'], false, false],
        ]);

        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/analysis-scenarios/{scenario_id}/executions', ['workspace_id' => [$workspaceId, 'string'], 'scenario_id' => [$scenarioId, 'string']]),
            Model\AnalysisScenarioExecutionList::class,
            $query,
            $headers
        );
    }

    /**
     * Создает запуск анализа.
     *
     * @param string $workspaceId
     * @param string $recordingId
     * @param Model\AnalysisRunCreate|array<string, mixed> $input
     * @return Model\AnalysisRunItemResponse
     */
    public function startAnalysisRun($workspaceId, $recordingId, $input)
    {
        $body = Model\AnalysisRunCreate::fromInput($input, 'input');

        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/recordings/{recording_id}/analysis-runs', ['workspace_id' => [$workspaceId, 'string'], 'recording_id' => [$recordingId, 'string']]),
            Model\AnalysisRunItemResponse::class,
            [],
            [],
            $body
        );
    }

    /**
     * Возвращает серверную страницу анализа со всеми
     * состояниями и фильтрами.
     *
     * @param string $workspaceId
     * @param array{
     *     isTest?: bool,
     *     annulmentStatus?: string,
     *     recordingId?: string,
     *     transcriptionRunId?: string,
     *     executionId?: string,
     *     id?: string,
     *     fileId?: string,
     *     transcriptionId?: string,
     *     search?: string,
     *     status?: list<string>,
     *     scenario?: list<string>,
     *     model?: list<string>,
     *     transcriptionScenario?: list<string>,
     *     hasSummary?: bool,
     *     flagsFrom?: int,
     *     flagsTo?: int,
     *     includeRetried?: bool,
     *     createdFrom?: string,
     *     createdTo?: string,
     *     recordedFrom?: string,
     *     recordedTo?: string,
     *     criterionId?: string,
     *     questionOp?: string,
     *     questionValue?: string,
     *     criterionFilters?: string,
     *     metadataFilters?: list<Model\MetadataFilter|array<string, mixed>>,
     *     metadataLogic?: string,
     *     metadataGroup?: Model\MetadataGroup|array<string, mixed>,
     *     sortBy?: string,
     *     sortDirection?: string,
     *     pageSize?: int,
     *     offset?: int,
     * } $options
     * @return Model\AnalysisRunList
     */
    public function listAnalysisRuns($workspaceId, $options = [])
    {
        list($query, $headers) = $this->parameters($options, [
            'isTest' => ['is_test', 'query', 'bool', false, false],
            'annulmentStatus' => ['annulment_status', 'query', 'string', false, false],
            'recordingId' => ['recording_id', 'query', 'string', false, false],
            'transcriptionRunId' => ['transcription_run_id', 'query', 'string', false, false],
            'executionId' => ['execution_id', 'query', 'string', false, false],
            'id' => ['id', 'query', 'string', false, false],
            'fileId' => ['file_id', 'query', 'string', false, false],
            'transcriptionId' => ['transcription_id', 'query', 'string', false, false],
            'search' => ['search', 'query', 'string', false, false],
            'status' => ['status', 'query', ['list', 'string'], false, false],
            'scenario' => ['scenario', 'query', ['list', 'string'], false, false],
            'model' => ['model', 'query', ['list', 'string'], false, false],
            'transcriptionScenario' => ['transcription_scenario', 'query', ['list', 'string'], false, false],
            'hasSummary' => ['has_summary', 'query', 'bool', false, false],
            'flagsFrom' => ['flags_from', 'query', 'int', false, false],
            'flagsTo' => ['flags_to', 'query', 'int', false, false],
            'includeRetried' => ['include_retried', 'query', 'bool', false, false],
            'createdFrom' => ['created_from', 'query', 'string', false, false],
            'createdTo' => ['created_to', 'query', 'string', false, false],
            'recordedFrom' => ['recorded_from', 'query', 'string', false, false],
            'recordedTo' => ['recorded_to', 'query', 'string', false, false],
            'criterionId' => ['criterion_id', 'query', 'string', false, false],
            'questionOp' => ['question_op', 'query', 'string', false, false],
            'questionValue' => ['question_value', 'query', 'string', false, false],
            'criterionFilters' => ['criterion_filters', 'query', 'string', false, false],
            'metadataFilters' => ['metadata_filters', 'query', ['list', \MindVoice\Sdk\Model\MetadataFilter::class], false, true],
            'metadataLogic' => ['metadata_logic', 'query', 'string', false, false],
            'metadataGroup' => ['metadata_group', 'query', \MindVoice\Sdk\Model\MetadataGroup::class, false, true],
            'sortBy' => ['sort_by', 'query', 'string', false, false],
            'sortDirection' => ['sort_direction', 'query', 'string', false, false],
            'pageSize' => ['page_size', 'query', 'int', false, false],
            'offset' => ['offset', 'query', 'int', false, false],
        ]);

        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/analysis-runs', ['workspace_id' => [$workspaceId, 'string']]),
            Model\AnalysisRunList::class,
            $query,
            $headers
        );
    }

    /**
     * Возвращает полную карточку по стабильному ID запуска.
     *
     * @param string $workspaceId
     * @param string $runId
     * @return Model\AnalysisRunDetailResponse
     */
    public function getAnalysisRun($workspaceId, $runId)
    {
        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/analysis-runs/{run_id}', ['workspace_id' => [$workspaceId, 'string'], 'run_id' => [$runId, 'string']]),
            Model\AnalysisRunDetailResponse::class
        );
    }

    /**
     * Разрешает старую прямую ссылку результата без поиска по
     * страницам.
     *
     * @param string $workspaceId
     * @param string $resultId
     * @return Model\AnalysisRunDetailResponse
     */
    public function getAnalysisResult($workspaceId, $resultId)
    {
        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/analysis-results/{result_id}', ['workspace_id' => [$workspaceId, 'string'], 'result_id' => [$resultId, 'string']]),
            Model\AnalysisRunDetailResponse::class
        );
    }

    /**
     * Повторяет завершённый анализ для той же версии
     * транскрибации.
     *
     * @param string $workspaceId
     * @param string $runId
     * @return Model\AnalysisRunDetailResponse
     */
    public function retryAnalysisRun($workspaceId, $runId)
    {
        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/analysis-runs/{run_id}/retry', ['workspace_id' => [$workspaceId, 'string'], 'run_id' => [$runId, 'string']]),
            Model\AnalysisRunDetailResponse::class
        );
    }

    /**
     * Аннулирует готовый результат с проверкой роли, scope и
     * изоляции Workspace.
     *
     * @param string $workspaceId
     * @param string $runId
     * @return Model\AnalysisRunDetailResponse
     */
    public function annulAnalysisRun($workspaceId, $runId)
    {
        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/analysis-runs/{run_id}/annul', ['workspace_id' => [$workspaceId, 'string'], 'run_id' => [$runId, 'string']]),
            Model\AnalysisRunDetailResponse::class
        );
    }

    /**
     * Отменяет анализ с проверкой роли, scope и доступности
     * записи.
     *
     * @param string $workspaceId
     * @param string $runId
     * @return Model\AnalysisRunDetailResponse
     */
    public function cancelAnalysisRun($workspaceId, $runId)
    {
        return $this->requestJson(
            'POST',
            $this->endpoint('/v1/workspaces/{workspace_id}/analysis-runs/{run_id}/cancel', ['workspace_id' => [$workspaceId, 'string'], 'run_id' => [$runId, 'string']]),
            Model\AnalysisRunDetailResponse::class
        );
    }

    /**
     * Возвращает результат анализа конкретного запуска.
     *
     * @param string $workspaceId
     * @param string $recordingId
     * @param string $analysisRunId
     * @param array{
     *     includeRecording?: bool,
     * } $options
     * @return Model\AnalysisResultItemResponse
     */
    public function getRecordingAnalysisResult($workspaceId, $recordingId, $analysisRunId, $options = [])
    {
        list($query, $headers) = $this->parameters($options, [
            'includeRecording' => ['include_recording', 'query', 'bool', false, false],
        ]);

        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/recordings/{recording_id}/analysis-results/{analysis_run_id}', ['workspace_id' => [$workspaceId, 'string'], 'recording_id' => [$recordingId, 'string'], 'analysis_run_id' => [$analysisRunId, 'string']]),
            Model\AnalysisResultItemResponse::class,
            $query,
            $headers
        );
    }

    /**
     * Возвращает страницу результатов анализа с фильтрами по
     * записи, транскрибации и сценарию.
     *
     * @param string $workspaceId
     * @param array{
     *     recordingId?: string,
     *     annulmentStatus?: string,
     *     transcriptionRunId?: string,
     *     analysisScenarioId?: string,
     *     includeRecording?: bool,
     *     pageSize?: int,
     *     offset?: int,
     * } $options
     * @return Model\AnalysisResultList
     */
    public function listAnalysisResults($workspaceId, $options = [])
    {
        list($query, $headers) = $this->parameters($options, [
            'recordingId' => ['recording_id', 'query', 'string', false, false],
            'annulmentStatus' => ['annulment_status', 'query', 'string', false, false],
            'transcriptionRunId' => ['transcription_run_id', 'query', 'string', false, false],
            'analysisScenarioId' => ['analysis_scenario_id', 'query', 'string', false, false],
            'includeRecording' => ['include_recording', 'query', 'bool', false, false],
            'pageSize' => ['page_size', 'query', 'int', false, false],
            'offset' => ['offset', 'query', 'int', false, false],
        ]);

        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/analysis-results', ['workspace_id' => [$workspaceId, 'string']]),
            Model\AnalysisResultList::class,
            $query,
            $headers
        );
    }

    /**
     * Возвращает общий локализованный каталог участнику Workspace.
     *
     * @param string $workspaceId
     * @param array{
     *     locale?: string,
     *     category?: string,
     * } $options
     * @return Model\AnalysisTemplateList
     */
    public function listAnalysisCriterionTemplates($workspaceId, $options = [])
    {
        list($query, $headers) = $this->parameters($options, [
            'locale' => ['locale', 'query', 'string', false, false],
            'category' => ['category', 'query', 'string', false, false],
        ]);

        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/analysis-criterion-templates', ['workspace_id' => [$workspaceId, 'string']]),
            Model\AnalysisTemplateList::class,
            $query,
            $headers
        );
    }

    /**
     * Возвращает сохранённую редакцию критерия с проверкой
     * доступа.
     *
     * @param string $workspaceId
     * @param string $templateId
     * @param int $version
     * @param array{
     *     locale?: string,
     * } $options
     * @return Model\AnalysisTemplateItemResponse
     */
    public function getAnalysisCriterionTemplateVersion($workspaceId, $templateId, $version, $options = [])
    {
        list($query, $headers) = $this->parameters($options, [
            'locale' => ['locale', 'query', 'string', false, false],
        ]);

        return $this->requestJson(
            'GET',
            $this->endpoint('/v1/workspaces/{workspace_id}/analysis-criterion-templates/{template_id}/versions/{version}', ['workspace_id' => [$workspaceId, 'string'], 'template_id' => [$templateId, 'string'], 'version' => [$version, 'int']]),
            Model\AnalysisTemplateItemResponse::class,
            $query,
            $headers
        );
    }
}
