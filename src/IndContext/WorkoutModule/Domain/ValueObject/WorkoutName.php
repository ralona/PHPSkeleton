<?php

declare(strict_types=1);

namespace App\IndContext\WorkoutModule\Domain\ValueObject;

use App\IndContext\WorkoutModule\Domain\Exception\InvalidWorkoutNameException;
use App\SharedContext\Domain\ValueObject\SimpleValueObject;

/**
 * @property string $value
 * @method __construct(string $value)
 * @method string value()
 */
class WorkoutName extends SimpleValueObject
{
    protected function invalidExceptionClass(): string
    {
        return InvalidWorkoutNameException::class;
    }

    public static function isValid(string $value): bool
    {
        return 256 >= strlen($value);
    }
}
