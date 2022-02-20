<?php

declare(strict_types=1);

namespace App\IndContext\CheatMealModule\Application\Command;

use App\IndContext\CheatMealModule\Domain\ValueObject\WeekNumber;
use App\IndContext\CheatMealModule\Domain\ValueObject\Year;
use App\IndContext\MealModule\Domain\ValueObject\MealId;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\Weekday;
use App\SharedContext\Application\Command\Command;

class CreateCheatMealCommand extends Command
{
    public function __construct(
        private MealId $mealId,
        private Weekday $weekday,
        private WeekNumber $weekNumber,
        private Year $year,
    ) {
    }

    public function mealId(): MealId
    {
        return $this->mealId;
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
