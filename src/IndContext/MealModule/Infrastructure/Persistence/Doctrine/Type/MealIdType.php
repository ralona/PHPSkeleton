<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Infrastructure\Persistence\Doctrine\Type;

use App\IndContext\MealModule\Domain\ValueObject\MealId;
use App\SharedContext\Infrastructure\Persistence\Doctrine\Type\UuidType;

class MealIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return MealId::class;
    }
}
