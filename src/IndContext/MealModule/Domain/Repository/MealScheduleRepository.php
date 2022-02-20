<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Domain\Repository;

use App\IndContext\MealModule\Domain\Model\MealSchedule;

interface MealScheduleRepository
{
    public function save(MealSchedule $mealSchedule): void;

    /** @return MealSchedule[] */
    public function all(): array;
}
