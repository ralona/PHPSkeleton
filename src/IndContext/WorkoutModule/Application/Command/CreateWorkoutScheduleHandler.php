<?php

declare(strict_types=1);

namespace App\IndContext\WorkoutModule\Application\Command;

use App\IndContext\SharedModule\Domain\ValueObject\Schedule\ScheduleId;
use App\IndContext\WorkoutModule\Domain\Exception\WorkoutIsOverlapingWithOtherException;
use App\IndContext\WorkoutModule\Domain\Model\WorkoutSchedule;
use App\IndContext\WorkoutModule\Domain\Repository\WorkoutScheduleRepository;
use App\SharedContext\Application\Command\CommandHandler;

class CreateWorkoutScheduleHandler extends CommandHandler
{
    public function __construct(
        private WorkoutScheduleRepository $workoutScheduleRepository
    ) {
    }

    public function handle(CreateWorkoutScheduleCommand $command): void
    {
        $workout = $this->workoutScheduleRepository->getByWeekdayAndTimePeriod(
            $command->weekday(),
            $command->schedule()
        );

        if (null !== $workout) {
            throw new WorkoutIsOverlapingWithOtherException($workout->id()->value());
        }

        $workout = new WorkoutSchedule(
            ScheduleId::generate(),
            $command->workoutName(),
            $command->schedule(),
            $command->weekday(),
        );

        $this->workoutScheduleRepository->save($workout);
    }
}
