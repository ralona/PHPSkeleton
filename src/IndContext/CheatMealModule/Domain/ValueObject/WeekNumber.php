<?php

declare(strict_types=1);

namespace App\IndContext\CheatMealModule\Domain\ValueObject;

use App\IndContext\CheatMealModule\Domain\Exception\InvalidWeekNumberException;
use App\SharedContext\Domain\ValueObject\SimpleValueObject;

/**
 * @property string $value
 * @method __construct(string $value)
 * @method string value()
 */
class WeekNumber extends SimpleValueObject
{
    protected function invalidExceptionClass(): string
    {
        return InvalidWeekNumberException::class;
    }

    public static function isValid(int $value): bool
    {
        return 0 < $value && 53 > $value;
    }
}
