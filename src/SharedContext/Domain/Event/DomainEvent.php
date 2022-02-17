<?php

namespace App\SharedContext\Domain\Event;

use Carbon\CarbonImmutable;

interface DomainEvent
{
    public function occurredOn(): CarbonImmutable;
}