<?php

declare(strict_types=1);

namespace App\IndContext\CheatMealModule\Infrastructure\Persistence\Doctrine\Type;

use App\IndContext\CheatMealModule\Domain\ValueObject\CheatMealId;
use App\SharedContext\Infrastructure\Persistence\Doctrine\Type\UuidType;

class CheatMealIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return CheatMealId::class;
    }
}
