<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Domain\Model;

use App\IndContext\SharedModule\Domain\Model\Schedule\BasicSchedule;
use App\IndContext\SharedModule\Domain\Model\Schedule\Schedule;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\ScheduleId;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\TimePeriod;

class MealSchedule extends BasicSchedule implements Schedule
{
    public function __construct(
        ScheduleId $id,
        private Meal $meal,
        TimePeriod $timePeriod,
    ) {
        parent::__construct($id, $timePeriod);
    }

    public function meal(): Meal
    {
        return $this->meal;
    }

    public function nameValue(): string
    {
        return $this->meal->kind()->value();
    }
}
