<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Domain\Model\Schedule;

use App\IndContext\SharedModule\Domain\ValueObject\Schedule\TimePeriod;

interface Schedule
{
    public function nameValue(): string;

    public function timePeriod(): TimePeriod;
}
