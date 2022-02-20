<?php

declare(strict_types=1);

namespace App\IndContext\WorkoutModule\Domain\Model;

use App\IndContext\SharedModule\Domain\Model\Schedule\BasicSchedule;
use App\IndContext\SharedModule\Domain\Model\Schedule\Schedule;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\ScheduleId;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\TimePeriod;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\Weekday;
use App\IndContext\WorkoutModule\Domain\ValueObject\WorkoutName;

class WorkoutSchedule extends BasicSchedule implements Schedule
{
    public function __construct(
        ScheduleId $id,
        private WorkoutName $name,
        TimePeriod $timePeriod,
        private Weekday $weekday
    ) {
        parent::__construct($id, $timePeriod);
    }

    public function name(): WorkoutName
    {
        return $this->name;
    }

    public function nameValue(): string
    {
        return $this->name->value();
    }

    public function weekday(): Weekday
    {
        return $this->weekday;
    }
}
