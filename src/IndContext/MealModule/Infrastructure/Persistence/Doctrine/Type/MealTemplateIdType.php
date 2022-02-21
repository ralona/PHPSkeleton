<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Infrastructure\Persistence\Doctrine\Type;

use App\IndContext\MealModule\Domain\ValueObject\MealTemplateId;
use App\SharedContext\Infrastructure\Persistence\Doctrine\Type\UuidType;

class MealTemplateIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return MealTemplateId::class;
    }
}
