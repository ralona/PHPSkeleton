<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Application\Services;

use App\IndContext\CheatMealModule\Domain\Model\CheatMeal;
use App\IndContext\MealModule\Domain\Model\MealSchedule;
use App\IndContext\WorkoutModule\Domain\Model\WorkoutSchedule;
use Carbon\CarbonInterface;

class CalulateMealSchedulesService
{
    /** @return MealSchedule[] */
    public function __invoke(
        CarbonInterface $date,
        array $mealSchedules,
        ?CheatMeal $cheatMeal,
        array $workoutSchedules,
    ): array {
        return array_filter(
            $mealSchedules,
            fn(MealSchedule $mealSchedule) => $this->evaluateMealSchedule($mealSchedule, $cheatMeal, ...
                $workoutSchedules)
        );
    }

    private function evaluateMealSchedule(
        MealSchedule $mealSchedule,
        ?CheatMeal $cheatMeal,
        WorkoutSchedule ...$workoutSchedules
    ): bool {
        if (
            null !== $cheatMeal &&
            $mealSchedule->meal()->id()->equals($cheatMeal->meal()->id())
        ) {
            return false;
        }

        foreach ($workoutSchedules as $workoutSchedule) {
            if ($workoutSchedule->timePeriod()->isOverlaping($mealSchedule->timePeriod())) {
                return false;
            }
        }

        return true;
    }
}
