<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Domain\ValueObject\Schedule;

use App\IndContext\WorkoutModule\Domain\Exception\InvalidWeekdayException;
use App\SharedContext\Domain\ValueObject\SimpleValueObject;

/**
 * @property int $value
 * @method  __construct(int $value)
 * @method int value()
 */
class Weekday extends SimpleValueObject
{
    protected function invalidExceptionClass(): string
    {
        return InvalidWeekdayException::class;
    }

    public static function isValid(int $value): bool
    {
        return 0 <= $value && 6 >= $value;
    }
}
