<?php

declare(strict_types=1);

namespace App\SharedContext\Domain\Event;

use Carbon\CarbonImmutable;

abstract class BaseDomainEvent implements DomainEvent
{
    private CarbonImmutable $occurredOn;

    public function __construct()
    {
        $this->occurredOn = CarbonImmutable::now('UTC');
    }

    public function occurredOn(): CarbonImmutable
    {
        return $this->occurredOn;
    }
}