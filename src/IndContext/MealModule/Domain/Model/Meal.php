<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Domain\Model;

use App\IndContext\MealModule\Domain\ValueObject\MealId;
use App\IndContext\MealModule\Domain\ValueObject\MealKind;

class Meal
{
    public function __construct(
        private MealId $id,
        private MealKind $kind,
    ) {
    }

    public function id(): MealId
    {
        return $this->id;
    }

    public function kind(): MealKind
    {
        return $this->kind;
    }
}
