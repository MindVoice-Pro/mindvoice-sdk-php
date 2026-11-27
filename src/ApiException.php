<?php

namespace MindVoice\Sdk;

use MindVoice\Sdk\Model\ApiError;
use RuntimeException;

/** Ошибка HTTP с типизированными сведениями MindVoice, если сервер их вернул. */
final class ApiException extends RuntimeException
{
    /** @var int */
    public $statusCode;

    /** @var ApiError|null */
    public $error;

    /** @var string|null */
    public $requestId;

    /** @var string */
    public $retryAfter;

    /** @var string */
    public $contentRange;

    /** Сохраняет статус, сведения API и заголовки для диагностики и повторов. */
    public function __construct($statusCode, $error, $requestId, $retryAfter, $contentRange)
    {
        $this->statusCode = $statusCode;
        $this->error = $error;
        $this->requestId = $requestId;
        $this->retryAfter = $retryAfter;
        $this->contentRange = $contentRange;

        $code = $error === null ? '' : $error->code;
        $suffix = $code === '' ? '' : " ({$code})";
        parent::__construct("MindVoice: HTTP {$statusCode}{$suffix}", $statusCode);
    }
}
