<?php

declare(strict_types=1);

namespace App\IndContext\WorkoutModule\Domain\Repository;

use App\IndContext\SharedModule\Domain\ValueObject\Schedule\ScheduleId;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\TimePeriod;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\Weekday;
use App\IndContext\WorkoutModule\Domain\Model\WorkoutSchedule;


interface WorkoutScheduleRepository
{
    public function save(WorkoutSchedule $workout): void;

    public function delete(WorkoutSchedule $workout): void;

    public function find(ScheduleId $workoutId): ?WorkoutSchedule;

    public function findOrFail(ScheduleId $workoutId): WorkoutSchedule;

    /** @return WorkoutSchedule[] */
    public function all(): array;

    public function getByWeekdayAndTimePeriod(Weekday $weekday, TimePeriod $schedule): ?WorkoutSchedule;
}
