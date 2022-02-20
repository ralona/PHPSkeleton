<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Domain\Model;

use App\IndContext\MealModule\Domain\ValueObject\MealTemplateId;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class MealTemplate
{
    private Collection $meals;

    public function __construct(
        private MealTemplateId $id,
        Meal ...$meals,
    ) {
        $this->meals = new ArrayCollection($meals);
    }

    public function id(): MealTemplateId
    {
        return $this->id;
    }

    /** @return Meal[] */
    public function meals(): array
    {
        return $this->meals->toArray();
    }

    public function mealsCount(): int
    {
        return $this->meals->count();
    }
}
