<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Domain\View\Calendar;

use App\IndContext\SharedModule\Domain\Model\Schedule\Schedule;
use DateTimeInterface;

class DayBlockView
{
    public string $date;

    /** @var BlockView[] */
    public array $blocks;

    public function __construct(
        DateTimeInterface $dateTime,
        Schedule ...$schedules,
    ) {
        $this->date = $dateTime->format('Y-m-d');
        $this->blocks = array_map(
            static fn(Schedule $schedule) => BlockView::createFromSchedule($schedule),
            $schedules
        );
    }
}
