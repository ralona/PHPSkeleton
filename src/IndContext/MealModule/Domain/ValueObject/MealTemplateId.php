<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Domain\ValueObject;

use App\SharedContext\Domain\ValueObject\Generic\Uuid;

class MealTemplateId extends Uuid
{
    protected function invalidExceptionClass(): string
    {
        return InvalidMealTemplateIdExcepetion::class;
    }
}
