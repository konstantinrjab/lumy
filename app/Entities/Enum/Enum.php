<?php

namespace App\Entities\Enum;
use ReflectionClass;

abstract class Enum
{
    private array $values;

    public static function getValues(): array
    {
        $class = new static();

        if ($class->values) {
            return $class->values;
        }
        $reflectionClass = new ReflectionClass(static::class);
        $class->values = $reflectionClass->getConstants();

        return $class->values;
    }

    public static function isValid(string $currency): bool
    {
        return in_array($currency, static::getValues());
    }
}
