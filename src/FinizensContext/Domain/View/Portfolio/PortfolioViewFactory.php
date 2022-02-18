<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\View\Portfolio;

use App\FinizensContext\Domain\Model\Portfolio\Portfolio;
use App\FinizensContext\Domain\View\Allocation\AllocationViewFactory;
use App\SharedContext\Domain\View\ViewFactory;

class PortfolioViewFactory extends ViewFactory
{
    public static function create(Portfolio $portfolio): PortfolioView
    {
        return new PortfolioView(
            $portfolio->id()->value(),
            ... AllocationViewFactory::makeCollection($portfolio->allocations()),
        );
    }
}