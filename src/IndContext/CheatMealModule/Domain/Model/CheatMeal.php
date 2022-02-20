<?php

declare(strict_types=1);

namespace App\IndContext\CheatMealModule\Domain\Model;

use App\IndContext\CheatMealModule\Domain\ValueObject\CheatMealId;
use App\IndContext\CheatMealModule\Domain\ValueObject\WeekNumber;
use App\IndContext\CheatMealModule\Domain\ValueObject\Year;
use App\IndContext\MealModule\Domain\Model\Meal;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\Weekday;

class CheatMeal
{
    public function __construct(
        private CheatMealId $id,
        private Meal $meal,
        private Weekday $weekday,
        private WeekNumber $weekNumber,
        private Year $year
    ) {
    }

    public function id(): CheatMealId
    {
        return $this->id;
    }

    public function meal(): Meal
    {
        return $this->meal;
    }

    public function weekday(): Weekday
    {
        return $this->weekday;
    }

    public function weekNumber(): WeekNumber
    {
        return $this->weekNumber;
    }

    public function year(): Year
    {
        return $this->year;
    }
}
