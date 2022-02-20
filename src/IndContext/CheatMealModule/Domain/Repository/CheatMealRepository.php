<?php

declare(strict_types=1);

namespace App\IndContext\CheatMealModule\Domain\Repository;

use App\IndContext\CheatMealModule\Domain\Model\CheatMeal;
use App\IndContext\CheatMealModule\Domain\ValueObject\WeekNumber;
use App\IndContext\CheatMealModule\Domain\ValueObject\Year;

interface CheatMealRepository
{
    public function save(CheatMeal $cheatMeal): void;

    public function delete(CheatMeal $cheatMeal): void;

    public function findByWeekAndYear(WeekNumber $weekNumber, Year $year): ?CheatMeal;

    /** @return CheatMeal[] */
    public function all(): array;
}
