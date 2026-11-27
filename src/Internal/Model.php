<?php

namespace MindVoice\Sdk\Internal;

use JsonSerializable;
use stdClass;

/** Общая реализация чтения и записи сгенерированных JSON-моделей. */
abstract class Model implements JsonSerializable
{
    /** @internal @var array<string, array{string, string|array, bool, bool}> */
    const FIELDS = [];

    /** @var array<string, mixed> */
    private $values;

    /** Сохраняет проверенные поля и их присутствие. */
    private function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * Собирает модель из массива с ключами lowerCamelCase.
     *
     * @param array<string, mixed> $fields
     * @return static
     */
    final public static function fromArray($fields)
    {
        return static::fromInput($fields, 'input');
    }

    /** Принимает готовую модель или проверяет массив входных полей. */
    final public static function fromInput($data, $path)
    {
        if ($data instanceof static) {
            return $data;
        }
        if (!is_array($data)) {
            throw Payload::invalid($path, true, 'ожидалась модель или массив полей');
        }

        return new static(static::normalize($data, true, $path));
    }

    /**
     * Собирает модель из JSON-объекта, допуская новые поля ответа API.
     *
     * @param mixed $data
     * @param string $path
     * @return static
     */
    final public static function fromObject($data, $path = 'response')
    {
        if (!$data instanceof stdClass) {
            throw Payload::invalid($path, false, 'ожидался JSON-объект');
        }

        return new static(static::normalize(get_object_vars($data), false, $path));
    }

    /** Проверяет обязательные поля, типы и допустимость явного null. */
    private static function normalize(array $data, $input, $path)
    {
        $values = [];
        foreach (static::FIELDS as $wireName => $definition) {
            list($property, $type, $required, $nullable) = $definition;
            $key = $input ? $property : $wireName;
            if (!array_key_exists($key, $data)) {
                if ($required) {
                    throw Payload::invalid($path . '.' . $key, $input, 'обязательное поле отсутствует');
                }
                continue;
            }

            // Ключ остаётся в массиве даже при явном null.
            $value = $data[$key];
            $values[$property] = $value === null && $nullable
                ? null
                : Payload::convert($value, $type, $path . '.' . $key, $input);
            unset($data[$key]);
        }

        if ($input && $data !== []) {
            reset($data);
            throw Payload::invalid($path . '.' . key($data), true, 'неизвестное поле');
        }

        return $values;
    }

    /** Возвращает свойство модели, включая null для отсутствующего необязательного значения. */
    final public function __get($name)
    {
        return isset($this->values[$name]) ? $this->values[$name] : null;
    }

    /** Проверяет, есть ли у свойства ненулевое значение. */
    final public function __isset($name)
    {
        return isset($this->values[$name]);
    }

    /** Запрещает изменение проверенных полей модели. */
    final public function __set($name, $value)
    {
        throw new \LogicException('Свойства модели доступны только для чтения.');
    }

    /** Запрещает удаление проверенных полей модели. */
    final public function __unset($name)
    {
        throw new \LogicException('Свойства модели доступны только для чтения.');
    }

    /**
     * Возвращает поля с исходными именами API и сохраняет явный null.
     *
     * @return stdClass
     */
    #[\ReturnTypeWillChange]
    final public function jsonSerialize()
    {
        $data = new stdClass();
        foreach (static::FIELDS as $wireName => $definition) {
            list($property, $type) = $definition;
            if (array_key_exists($property, $this->values)) {
                $data->{$wireName} = Payload::toWire($this->values[$property], $type);
            }
        }

        return $data;
    }
}
