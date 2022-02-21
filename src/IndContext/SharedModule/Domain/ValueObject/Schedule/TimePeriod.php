<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Domain\ValueObject\Schedule;

use App\IndContext\SharedModule\Domain\Exception\Schedule\InvalidTimePeriodException;
use App\SharedContext\Domain\ValueObject\ValueObject;

class TimePeriod extends ValueObject
{
    public function __construct(
        private Time $startTime,
        private Time $endTime,
    ) {
        $this->validate([$startTime, $endTime]);
    }

    public static function deserialize(string $startTime, string $endTime): self
    {
        return new self(new Time($startTime), new Time($endTime));
    }

    public static function isValid(Time $startTime, Time $endTime): bool
    {
        return $startTime->isLessThan($endTime);
    }

    protected function invalidExceptionClass(): string
    {
        return InvalidTimePeriodException::class;
    }

    public function startTime(): Time
    {
        return $this->startTime;
    }

    public function endTime(): Time
    {
        return $this->endTime;
    }

    public function isInRange(Time $time): bool
    {
        return $this->startTime->isLessThan($time) && $this->endTime->isMoreThan($time);
    }

    public function isOverlaping(TimePeriod $timePeriod): bool
    {
        return $this->isInRange($timePeriod->startTime) ||
            $this->isInRange($timePeriod->endTime) ||
            $timePeriod->isInRange($this->startTime);
    }
}
