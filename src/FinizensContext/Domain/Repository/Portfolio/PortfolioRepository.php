<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\Repository\Portfolio;

use App\FinizensContext\Domain\Model\Portfolio\Portfolio;
use App\FinizensContext\Domain\ValueObject\Portfolio\PortfolioId;

interface PortfolioRepository
{
    public function byId(PortfolioId $portfolioId): ?Portfolio;

    /** @return Portfolio[] */
    public function all(): array;

    public function save(Portfolio $portfolio): void;
}