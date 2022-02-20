<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Application\Services;

use App\IndContext\WorkoutModule\Domain\Model\WorkoutSchedule;
use Carbon\CarbonInterface;

class CalculateWorkoutSchedulesService
{
    /** @return WorkoutSchedule[] */
    public function __invoke(
        CarbonInterface $date,
        WorkoutSchedule ...$workoutSchedules
    ): array {
        return array_filter(
            $workoutSchedules,
            static fn(WorkoutSchedule $workoutSchedule) => $workoutSchedule->weekday()->value() === $date->dayOfWeek
        );
    }
}
