<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Результат одного поискового запроса в аудиоканале, включая
 * отсутствие совпадений.
 *
 * @property-read string $query
 * @property-read int $channel
 * @property-read list<TranscriptSearchHit>|null $hits
 */
final class TranscriptSearchResult extends Model
{
    /** @internal */
    const FIELDS = [
        'query' => ['query', 'string', true, false],
        'channel' => ['channel', 'int', true, false],
        'hits' => ['hits', ['list', \MindVoice\Sdk\Model\TranscriptSearchHit::class], false, false],
    ];
}
