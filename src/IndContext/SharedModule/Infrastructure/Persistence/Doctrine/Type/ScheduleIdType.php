<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Infrastructure\Persistence\Doctrine\Type;

use App\IndContext\SharedModule\Domain\ValueObject\Schedule\ScheduleId;
use App\SharedContext\Infrastructure\Persistence\Doctrine\Type\UuidType;

class ScheduleIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return ScheduleId::class;
    }
}
