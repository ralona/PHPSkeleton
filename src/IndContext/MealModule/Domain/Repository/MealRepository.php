<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Domain\Repository;

use App\IndContext\MealModule\Domain\Model\Meal;
use App\IndContext\MealModule\Domain\ValueObject\MealId;

interface MealRepository
{
    public function save(Meal $meal): void;

    public function delete(Meal $meal): void;

    public function find(MealId $mealId): ?Meal;

    public function findOrFail(MealId $mealId): Meal;

    /** @return Meal[] */
    public function findByIds(MealId ...$mealIds): array;
}
