<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Domain\ValueObject\Schedule;

use App\IndContext\SharedModule\Domain\Exception\Schedule\InvalidScheduleIdException;
use App\SharedContext\Domain\ValueObject\Generic\Uuid;

class ScheduleId extends Uuid
{
    protected function invalidExceptionClass(): string
    {
        return InvalidScheduleIdException::class;
    }
}
