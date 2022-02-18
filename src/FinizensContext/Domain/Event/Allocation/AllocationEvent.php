<?php

namespace App\FinizensContext\Domain\Event\Allocation;

use App\FinizensContext\Domain\ValueObject\Allocation\AllocationId;
use App\SharedContext\Domain\Event\DomainEvent;

interface AllocationEvent extends DomainEvent
{
    public function allocationId(): AllocationId;
}