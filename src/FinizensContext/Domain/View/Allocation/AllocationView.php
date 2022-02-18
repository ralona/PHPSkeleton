<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\View\Allocation;

class AllocationView
{
    public string $id;
    public int $shares;

    public function __construct(
        string $allocationId,
        int $shares
    ) {
        $this->id = $allocationId;
        $this->shares = $shares;
    }

}