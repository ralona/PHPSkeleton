<?php

declare(strict_types=1);

namespace App\IndContext\WorkoutModule\Infrastructure\Persistence\Doctrine\Repository;

use App\IndContext\SharedModule\Domain\ValueObject\Schedule\ScheduleId;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\TimePeriod;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\Weekday;
use App\IndContext\WorkoutModule\Domain\Exception\WorkoutScheduleNotFoundException;
use App\IndContext\WorkoutModule\Domain\Model\WorkoutSchedule;
use App\IndContext\WorkoutModule\Domain\Repository\WorkoutScheduleRepository;
use App\SharedContext\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;

class DoctrineWorkoutScheduleRepository extends BaseRepository implements WorkoutScheduleRepository
{
    protected function entityClassName(): string
    {
        return WorkoutSchedule::class;
    }

    public function save(WorkoutSchedule $workout): void
    {
        $this->_em->persist($workout);
    }

    public function delete(WorkoutSchedule $workout): void
    {
        $this->_em->persist($workout);
    }

    public function find(ScheduleId $workoutId): ?WorkoutSchedule
    {
        return $this->repository->find($workoutId);
    }

    public function findOrFail(ScheduleId $workoutId): WorkoutSchedule
    {
        $workoutSchedule = $this->find($workoutId);
        if (null === $workoutSchedule) {
            throw new WorkoutScheduleNotFoundException();
        }

        return $workoutSchedule;
    }

    public function all(): array
    {
        return $this->repository->findAll();
    }

    public function getByWeekdayAndTimePeriod(Weekday $weekday, TimePeriod $schedule): ?WorkoutSchedule
    {
        return null;
    }
}
