<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Domain\Repository;

use App\IndContext\MealModule\Domain\Model\MealTemplate;
use App\IndContext\MealModule\Domain\ValueObject\MealTemplateId;

interface MealTemplateRepository
{
    public function save(MealTemplate $mealTemplate): void;

    public function delete(MealTemplate $mealTemplate): void;

    public function find(MealTemplateId $mealTemplateId): ?MealTemplate;

    public function findOrFail(MealTemplateId $mealTemplateId): MealTemplate;

    /** @return MealTemplate[] */
    public function all(): array;
}
