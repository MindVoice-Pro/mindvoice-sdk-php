<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение TokenUsage.
 *
 * @property-read string $inputTokens
 * @property-read string $outputTokens
 * @property-read string $totalTokens
 * @property-read string|null $cachedInputTokens
 * @property-read string|null $reasoningTokens
 */
final class TokenUsage extends Model
{
    /** @internal */
    const FIELDS = [
        'input_tokens' => ['inputTokens', 'string', true, false],
        'output_tokens' => ['outputTokens', 'string', true, false],
        'total_tokens' => ['totalTokens', 'string', true, false],
        'cached_input_tokens' => ['cachedInputTokens', 'string', false, false],
        'reasoning_tokens' => ['reasoningTokens', 'string', false, false],
    ];
}
