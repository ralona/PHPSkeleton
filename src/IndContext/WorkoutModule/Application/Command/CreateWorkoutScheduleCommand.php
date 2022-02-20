<?php

declare(strict_types=1);

namespace App\IndContext\WorkoutModule\Application\Command;

use App\IndContext\SharedModule\Domain\ValueObject\Schedule\TimePeriod;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\Weekday;
use App\IndContext\WorkoutModule\Domain\ValueObject\WorkoutName;
use App\SharedContext\Application\Command\Command;

class CreateWorkoutScheduleCommand extends Command
{
    public function __construct(
        private WorkoutName $workoutName,
        private Weekday $weekday,
        private TimePeriod $schedule,
    ) {
    }

    public function workoutName(): WorkoutName
    {
        return $this->workoutName;
    }

    public function weekday(): Weekday
    {
        return $this->weekday;
    }

    public function schedule(): TimePeriod
    {
        return $this->schedule;
    }
}
