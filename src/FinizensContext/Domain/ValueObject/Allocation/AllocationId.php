<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\ValueObject\Allocation;

use App\FinizensContext\Domain\Exception\Allocation\InvalidAllocationIdException;
use App\SharedContext\Domain\ValueObject\Generic\Id;

class AllocationId extends Id
{
    protected function invalidExceptionClass(): string
    {
        return InvalidAllocationIdException::class;
    }
}