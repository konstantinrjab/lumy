<?php

namespace App\Entities\Enum;
use ReflectionClass;

abstract class Enum
{
    protected static $values;

    public static function getValues(): array
    {
        if (static::$values) {
            return static::$values;
        }
        $reflectionClass = new ReflectionClass(static::class);
        static::$values = $reflectionClass->getConstants();

        return static::$values;
    }

    public static function isValid(string $currency): bool
    {
        return in_array($currency, static::getValues());
    }
}
