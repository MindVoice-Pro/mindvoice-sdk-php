<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение RecognitionSettings.
 *
 * @property-read string|null $language
 * @property-read bool|null $diarization
 * @property-read bool|null $punctuation
 * @property-read \stdClass|null $providerOptions
 */
final class RecognitionSettings extends Model
{
    /** @internal */
    const FIELDS = [
        'language' => ['language', 'string', false, false],
        'diarization' => ['diarization', 'bool', false, false],
        'punctuation' => ['punctuation', 'bool', false, false],
        'provider_options' => ['providerOptions', 'stdClass', false, false],
    ];
}
