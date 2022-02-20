<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Domain\ValueObject;

use App\IndContext\MealModule\Domain\Exception\InvalidMealIdException;
use App\SharedContext\Domain\ValueObject\Generic\Uuid;

class MealId extends Uuid
{
    protected function invalidExceptionClass(): string
    {
        return InvalidMealIdException::class;
    }
}
