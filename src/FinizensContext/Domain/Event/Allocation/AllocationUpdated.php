<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\Event\Allocation;

use App\FinizensContext\Domain\ValueObject\Allocation\AllocationId;
use App\SharedContext\Domain\Event\BaseDomainEvent;

class AllocationUpdated extends BaseDomainEvent implements AllocationEvent
{
    private string $portfolioId;

    public function __construct(AllocationId $portfolioId)
    {
        parent::__construct();

        $this->portfolioId = $portfolioId->value();
    }

    public function allocationId(): AllocationId
    {
        return new AllocationId($this->portfolioId);
    }
}