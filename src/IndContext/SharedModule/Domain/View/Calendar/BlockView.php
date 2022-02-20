<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Domain\View\Calendar;

use App\IndContext\SharedModule\Domain\Model\Schedule\Schedule;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\TimePeriod;

class BlockView
{
    public string $startTime;
    public string $endTime;

    public function __construct(
        public string $name,
        TimePeriod $schedule,
    ) {
        $this->startTime = $schedule->startTime()->value();
        $this->endTime = $schedule->endTime()->value();
    }

    public static function createFromSchedule(Schedule $schedule): self
    {
        return new self($schedule->nameValue(), $schedule->timePeriod());
    }
}
