<?php

namespace MindVoice\Sdk\Internal;

/** Читает multipart из префикса, исходного файла и завершающей границы. */
final class MultipartBody
{
    /** @var string */
    private $prefix;

    /** @var resource|null */
    private $file;

    /** @var string */
    private $suffix;

    /** @var string */
    private $boundary;

    /** @var int|null */
    private $size;

    /** @var bool */
    private $readFailed = false;

    /** Принимает готовую обвязку multipart и сохраняет размер оставшейся части файла. */
    public function __construct($prefix, $file, $suffix, $boundary)
    {
        $this->prefix = $prefix;
        $this->file = $file;
        $this->suffix = $suffix;
        $this->boundary = $boundary;

        // Размер сокета или канала неизвестен. Для обычного файла учитываем текущую позицию.
        $stat = @fstat($file);
        $position = $stat !== false && ($stat['mode'] & 0170000) === 0100000 ? ftell($file) : false;
        $size = $position === false ? null : strlen($prefix) + max(0, $stat['size'] - $position) + strlen($suffix);
        $this->size = is_int($size) ? $size : null;
    }

    /** Возвращает значение Content-Type с границей multipart. */
    public function getContentType()
    {
        return 'multipart/form-data; boundary=' . $this->boundary;
    }

    /** Возвращает размер тела при известном размере потока. */
    public function getSize()
    {
        return $this->size;
    }

    /** Сообщает, что поток файла оборвался при чтении. */
    public function readFailed()
    {
        return $this->readFailed;
    }

    /** Возвращает очередную часть тела в пределах размера буфера cURL. */
    public function read($length)
    {
        // Префикс и суффикс уже находятся в памяти, файл читаем по мере запроса.
        $chunk = substr($this->prefix, 0, $length);
        $this->prefix = (string) substr($this->prefix, strlen($chunk));
        $remaining = $length - strlen($chunk);

        if ($remaining > 0 && $this->file !== null) {
            $bytes = @fread($this->file, $remaining);
            if ($bytes === false || ($bytes === '' && !feof($this->file))) {
                $this->readFailed = true;
                return '';
            }

            $chunk .= $bytes;
            $remaining -= strlen($bytes);
            if (feof($this->file)) {
                // Поток принадлежит приложению, по окончании только освобождаем ссылку.
                $this->file = null;
            }
        }

        if ($remaining > 0 && $this->file === null) {
            $part = substr($this->suffix, 0, $remaining);
            $this->suffix = (string) substr($this->suffix, strlen($part));
            $chunk .= $part;
        }

        return $chunk;
    }
}
