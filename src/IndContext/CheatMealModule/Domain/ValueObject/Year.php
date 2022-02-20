<?php

declare(strict_types=1);

namespace App\IndContext\CheatMealModule\Domain\ValueObject;

use App\IndContext\CheatMealModule\Domain\Exception\InvalidYearException;
use App\SharedContext\Domain\ValueObject\SimpleValueObject;

/**
 * @property int $value
 * @method __construct(int $value)
 * @method int value()
 */
class Year extends SimpleValueObject
{
    protected function invalidExceptionClass(): string
    {
        return InvalidYearException::class;
    }

    public static function isValid(int $value): bool
    {
        return 0 <= $value && 10000 > $value;
    }
}
