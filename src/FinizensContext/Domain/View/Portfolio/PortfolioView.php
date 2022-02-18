<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\View\Portfolio;

use App\FinizensContext\Domain\View\Allocation\AllocationView;

class PortfolioView
{
    public string $id;
    public array $allocations;

    public function __construct(
        string $portfolioId,
        AllocationView ...$allocationViews
    ) {
        $this->id = $portfolioId;
        $this->allocations = $allocationViews;
    }

}