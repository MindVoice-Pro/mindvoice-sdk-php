<?php

namespace MindVoice\Sdk;

use MindVoice\Sdk\Internal\MultipartBody;
use MindVoice\Sdk\Internal\Payload;

/** Входные данные загрузки. Поток файла принадлежит приложению. */
final class UploadRecordingInput
{
    /** @var array<string, mixed> */
    private $fields;

    /**
     * Принимает открытый читаемый поток и параметры записи.
     *
     * @param array{file: resource, filename: string, contentType: string, metadata?: array|\stdClass,
     *     recordedAt?: string, retentionDays?: int, checkDuplicates?: bool} $fields
     */
    public function __construct($fields)
    {
        if (!is_array($fields)) {
            throw Payload::invalid('input', true, 'ожидался массив полей загрузки');
        }

        // Открытый поток должен поддерживать чтение. Имя и MIME-тип входят в заголовки multipart.
        $file = isset($fields['file']) ? $fields['file'] : null;
        if (!is_resource($file) || get_resource_type($file) !== 'stream') {
            throw Payload::invalid('input.file', true, 'ожидался открытый поток файла');
        }
        $mode = stream_get_meta_data($file);
        if (strpos($mode['mode'], 'r') !== 0 && strpos($mode['mode'], '+') === false) {
            throw Payload::invalid('input.file', true, 'поток должен быть открыт для чтения');
        }
        $filename = isset($fields['filename']) ? $fields['filename'] : null;
        if (!is_string($filename) || trim($filename) === '' || preg_match('/[\x00-\x1f\x7f]/', $filename) === 1) {
            throw Payload::invalid('input.filename', true, 'укажите допустимое имя файла');
        }
        $contentType = isset($fields['contentType']) ? $fields['contentType'] : null;
        if (!is_string($contentType) || preg_match('~\A[\w.+-]+/[\w.+-]+(?:;[^\x00-\x1f\x7f]*)?\z~', $contentType) !== 1) {
            throw Payload::invalid('input.contentType', true, 'укажите допустимый MIME-тип файла');
        }

        // Проверяем необязательные поля и сохраняем явное false.
        $validated = ['file' => $file, 'filename' => $filename, 'contentType' => $contentType];
        $optional = ['metadata' => 'stdClass', 'recordedAt' => 'string', 'retentionDays' => 'int', 'checkDuplicates' => 'bool'];
        foreach ($optional as $name => $type) {
            if (array_key_exists($name, $fields)) {
                $validated[$name] = Payload::convert($fields[$name], $type, 'input.' . $name, true);
            }
        }
        if (isset($validated['retentionDays']) && $validated['retentionDays'] < 1) {
            throw Payload::invalid('input.retentionDays', true, 'срок хранения должен быть не меньше одного дня');
        }
        $unknown = array_diff_key($fields, $validated);
        if ($unknown !== []) {
            reset($unknown);
            throw Payload::invalid('input.' . key($unknown), true, 'неизвестное поле');
        }

        $this->fields = $validated;
    }

    /**
     * Собирает multipart вокруг текущей позиции исходного потока файла.
     *
     * @internal
     * @return MultipartBody
     */
    public function multipart()
    {
        // Поток могли закрыть после создания входного объекта.
        $file = $this->fields['file'];
        if (!is_resource($file)) {
            throw Payload::invalid('input.file', true, 'поток закрыт');
        }

        $bytes = function_exists('random_bytes') ? random_bytes(24) : openssl_random_pseudo_bytes(24);
        if ($bytes === false) {
            throw new TransportException('Не удалось создать границу multipart.');
        }
        $boundary = bin2hex($bytes);
        $prefix = '';
        foreach ([
            'metadata' => 'metadata',
            'recordedAt' => 'recorded_at',
            'retentionDays' => 'retention_days',
            'checkDuplicates' => 'check_duplicates',
        ] as $property => $name) {
            if (!isset($this->fields[$property])) {
                continue;
            }

            $prefix .= "--{$boundary}\r\nContent-Disposition: form-data; name=\"{$name}\"\r\n";
            $value = $this->fields[$property];
            if ($property === 'metadata') {
                $prefix .= "Content-Type: application/json\r\n";
                $value = Payload::encode($value);
            } elseif (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            $prefix .= "\r\n{$value}\r\n";
        }

        // Экранируем имя файла и сохраняем его в UTF-8.
        $filename = addcslashes($this->fields['filename'], "\\\"");
        $prefix .= "--{$boundary}\r\nContent-Disposition: form-data; name=\"file\"; filename=\"{$filename}\"\r\n"
            . "Content-Type: {$this->fields['contentType']}\r\n\r\n";

        return new MultipartBody($prefix, $file, "\r\n--{$boundary}--\r\n", $boundary);
    }
}
