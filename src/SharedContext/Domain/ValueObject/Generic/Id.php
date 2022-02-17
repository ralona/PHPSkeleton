<?php

declare(strict_types=1);

namespace App\SharedContext\Domain\ValueObject\Generic;

use App\SharedContext\Domain\ValueObject\SimpleValueObject;

abstract class Id extends SimpleValueObject
{
    public static function isValid($value): bool
    {
        return is_int($value) && $value > 0 && $value <= PHP_INT_MAX;
    }

    public function value(): string
    {
        return parent::value();
    }
}