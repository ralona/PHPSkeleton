<?php

declare(strict_types=1);

namespace App\IndContext\CheatMealModule\Domain\ValueObject;

use App\IndContext\CheatMealModule\Domain\Exception\InvalidCheatMealIdException;
use App\SharedContext\Domain\ValueObject\Generic\Uuid;

class CheatMealId extends Uuid
{
    protected function invalidExceptionClass(): string
    {
        return InvalidCheatMealIdException::class;
    }
}
