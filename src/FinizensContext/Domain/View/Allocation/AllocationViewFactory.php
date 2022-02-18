<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\View\Allocation;

use App\FinizensContext\Domain\Model\Portfolio\Allocation;
use App\SharedContext\Domain\View\ViewFactory;

class AllocationViewFactory extends ViewFactory
{
    public static function create(Allocation $allocation): AllocationView
    {
        return new AllocationView(
            $allocation->id()->value(),
            $allocation->shares()->value(),
        );
    }
}