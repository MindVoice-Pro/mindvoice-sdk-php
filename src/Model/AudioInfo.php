<?php

// Сгенерировано из публичной OpenAPI. Изменения вносите в генератор.

namespace MindVoice\Sdk\Model;

use MindVoice\Sdk\Internal\Model;

/**
 * Типизированное сообщение AudioInfo.
 *
 * @property-read string|null $containerFormat
 * @property-read string|null $codec
 * @property-read int|null $bitrateKbps
 * @property-read string|null $bitrateMode
 * @property-read int|null $sampleRateHz
 * @property-read int|null $channels
 * @property-read string|null $channelLayout
 * @property-read int|null $bitDepth
 * @property-read string|null $encoder
 * @property-read string|null $originalCreatedAt
 * @property-read float|null $durationSeconds
 * @property-read AudioQuality|null $quality
 * @property-read array<string, string>|null $tags
 * @property-read string|null $sampleFormat
 */
final class AudioInfo extends Model
{
    /** @internal */
    const FIELDS = [
        'container_format' => ['containerFormat', 'string', false, false],
        'codec' => ['codec', 'string', false, false],
        'bitrate_kbps' => ['bitrateKbps', 'int', false, false],
        'bitrate_mode' => ['bitrateMode', 'string', false, false],
        'sample_rate_hz' => ['sampleRateHz', 'int', false, false],
        'channels' => ['channels', 'int', false, false],
        'channel_layout' => ['channelLayout', 'string', false, false],
        'bit_depth' => ['bitDepth', 'int', false, false],
        'encoder' => ['encoder', 'string', false, false],
        'original_created_at' => ['originalCreatedAt', 'string', false, false],
        'duration_seconds' => ['durationSeconds', 'float', false, false],
        'quality' => ['quality', \MindVoice\Sdk\Model\AudioQuality::class, false, false],
        'tags' => ['tags', ['map', 'string'], false, false],
        'sample_format' => ['sampleFormat', 'string', false, false],
    ];
}
