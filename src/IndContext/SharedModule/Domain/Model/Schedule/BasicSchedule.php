<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Domain\Model\Schedule;

use App\IndContext\SharedModule\Domain\ValueObject\Schedule\ScheduleId;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\TimePeriod;

abstract class BasicSchedule
{
    public function __construct(
        protected ScheduleId $id,
        protected TimePeriod $timePeriod
    ) {
    }

    public function id(): ScheduleId
    {
        return $this->id;
    }

    public function timePeriod(): TimePeriod
    {
        return $this->timePeriod;
    }
}
