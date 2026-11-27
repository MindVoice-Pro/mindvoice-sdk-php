<?php

namespace MindVoice\Sdk\Internal;

use InvalidArgumentException;
use stdClass;
use UnexpectedValueException;

/** Кодирует JSON и проверяет типы из сгенерированного контракта. */
final class Payload
{
    /**
     * Кодирует данные для тела запроса или JSON-параметра.
     *
     * @param mixed $value
     * @return string
     */
    public static function encode($value)
    {
        $json = json_encode($value, JSON_PRESERVE_ZERO_FRACTION | JSON_UNESCAPED_UNICODE);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException('Не удалось закодировать JSON запроса: ' . json_last_error_msg());
        }

        return $json;
    }

    /**
     * Декодирует JSON, различая объекты, списки и целые числа вне диапазона PHP.
     *
     * @param string $json
     * @return mixed
     */
    public static function decode($json)
    {
        $value = json_decode($json, false, 512, JSON_BIGINT_AS_STRING);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new UnexpectedValueException('MindVoice вернул некорректный JSON: ' . json_last_error_msg());
        }

        return $value;
    }

    /**
     * Проверяет значение и преобразует составные данные в модели SDK.
     *
     * @param mixed $value
     * @param string|array $type
     * @param string $field
     * @param bool $input
     * @return mixed
     */
    public static function convert($value, $type, $field, $input)
    {
        if (is_array($type)) {
            return self::convertCompound($value, $type, $field, $input);
        }

        // Для чисел и логических значений исключаем неявное приведение строк.
        switch ($type) {
            case 'mixed':
                return $value;
            case 'string':
                if (is_string($value)) {
                    return $value;
                }
                break;
            case 'int':
                if (is_int($value)) {
                    return $value;
                }
                break;
            case 'float':
                if ((is_int($value) || is_float($value)) && is_finite((float) $value)) {
                    return (float) $value;
                }
                break;
            case 'bool':
                if (is_bool($value)) {
                    return $value;
                }
                break;
            case 'stdClass':
                if ($input && is_array($value)) {
                    return (object) $value;
                }
                if ($value instanceof stdClass) {
                    return $value;
                }
                break;
            case 'null':
                if ($value === null) {
                    return null;
                }
                break;
            default:
                return $input ? $type::fromInput($value, $field) : $type::fromObject($value, $field);
        }

        throw self::invalid($field, $input, 'ожидался тип ' . $type);
    }

    /** Проверяет элементы коллекций и допустимые варианты объединения. */
    private static function convertCompound($value, array $type, $field, $input)
    {
        switch ($type[0]) {
            case 'list':
                if (!is_array($value)) {
                    throw self::invalid($field, $input, 'ожидался список');
                }
                $items = [];
                foreach ($value as $index => $item) {
                    if ($index !== count($items)) {
                        throw self::invalid($field, $input, 'ожидался список');
                    }
                    $items[] = self::convert($item, $type[1], $field . '[' . $index . ']', $input);
                }
                return $items;
            case 'map':
                if (!$value instanceof stdClass && !($input && is_array($value))) {
                    throw self::invalid($field, $input, 'ожидался словарь');
                }
                $items = [];
                foreach ((array) $value as $key => $item) {
                    $items[$key] = self::convert($item, $type[1], $field . '.' . $key, $input);
                }
                return $items;
            case 'union':
                foreach ($type[1] as $variant) {
                    try {
                        return self::convert($value, $variant, $field, $input);
                    } catch (InvalidArgumentException $error) {
                        // Пробуем следующую допустимую форму входного значения.
                    } catch (UnexpectedValueException $error) {
                        // Пробуем следующую допустимую форму ответа.
                    }
                }
                throw self::invalid($field, $input, 'значение не соответствует допустимым формам');
            case 'nullable':
                return $value === null ? null : self::convert($value, $type[1], $field, $input);
            case 'enum':
                if (in_array($value, $type[1], true)) {
                    return $value;
                }
                throw self::invalid($field, $input, 'допустимые значения: ' . implode(', ', $type[1]));
        }

        throw new \LogicException('Неизвестный тип схемы PHP SDK.');
    }

    /** Готовит коллекции к JSON-кодированию, в том числе пустой словарь как объект. */
    public static function toWire($value, $type)
    {
        if ($value === null || !is_array($type)) {
            return $value;
        }

        switch ($type[0]) {
            case 'list':
            case 'map':
                $items = [];
                foreach ($value as $key => $item) {
                    $items[$key] = self::toWire($item, $type[1]);
                }
                return $type[0] === 'map' ? (object) $items : $items;
            case 'nullable':
                return self::toWire($value, $type[1]);
            default:
                return $value;
        }
    }

    /** Создаёт ошибку контракта с именем поля без его значения. */
    public static function invalid($field, $input, $reason)
    {
        $message = $field . ': ' . $reason . '.';

        return $input
            ? new InvalidArgumentException($message)
            : new UnexpectedValueException('Некорректный ответ MindVoice. ' . $message);
    }
}
