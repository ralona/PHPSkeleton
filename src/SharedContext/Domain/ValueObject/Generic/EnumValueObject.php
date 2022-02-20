<?php

declare(strict_types=1);

namespace App\SharedContext\Domain\ValueObject\Generic;

use App\SharedContext\Domain\ValueObject\SimpleValueObject;
use ReflectionClass;

/** @property string $value */
abstract class EnumValueObject extends SimpleValueObject
{
    public static function isValid($value): bool
    {
        return is_string($value) && in_array($value, self::allValues(), true);
    }

    public static function allValues(): array
    {
        return (new ReflectionClass(static::class))->getConstants();
    }

    public function value(): string
    {
        return parent::value();
    }
}
