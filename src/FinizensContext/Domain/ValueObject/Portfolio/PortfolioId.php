<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\ValueObject\Portfolio;

use App\FinizensContext\Domain\Exception\Portfolio\InvalidPortfolioIdException;
use App\SharedContext\Domain\ValueObject\Generic\Id;

class PortfolioId extends Id
{
    protected function invalidExceptionClass(): string
    {
        return InvalidPortfolioIdException::class;
    }
}