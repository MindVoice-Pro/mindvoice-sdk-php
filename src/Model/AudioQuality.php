<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение AudioQuality.
 *
 * @property-read float|null $silenceSeconds
 * @property-read float|null $peakDbfs
 * @property-read bool|null $hasClipping
 * @property-read float|null $clippedSamplesRatio
 * @property-read float|null $averageLoudnessLufs
 * @property-read string|null $warning
 */
final class AudioQuality extends Model
{
    /** @internal */
    const FIELDS = [
        'silence_seconds' => ['silenceSeconds', 'float', false, false],
        'peak_dbfs' => ['peakDbfs', 'float', false, false],
        'has_clipping' => ['hasClipping', 'bool', false, false],
        'clipped_samples_ratio' => ['clippedSamplesRatio', 'float', false, false],
        'average_loudness_lufs' => ['averageLoudnessLufs', 'float', false, false],
        'warning' => ['warning', 'string', false, false],
    ];
}
