<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\Service\Portfolio;

use App\FinizensContext\Domain\Exception\Allocation\AllocationNotFoundException;
use App\FinizensContext\Domain\Exception\Portfolio\PortfolioNotFoundException;
use App\FinizensContext\Domain\Repository\Portfolio\PortfolioRepository;
use App\FinizensContext\Domain\ValueObject\Allocation\AllocationId;
use App\FinizensContext\Domain\ValueObject\Allocation\Shares;
use App\FinizensContext\Domain\ValueObject\Portfolio\PortfolioId;

class SellSharesService
{
    private PortfolioRepository $portfolioRepository;

    public function __construct(PortfolioRepository $portfolioRepository)
    {
        $this->portfolioRepository = $portfolioRepository;
    }

    public function handle(PortfolioId $portfolioId, AllocationId $allocationId, Shares $shares): void
    {
        $portfolio = $this->portfolioRepository->byId($portfolioId);
        if (null === $portfolio) {
            throw new PortfolioNotFoundException((string)$portfolioId->value());
        }

        $allocation = $portfolio->allocation($allocationId);
        if (null === $allocation) {
            throw new AllocationNotFoundException((string)$allocationId->value());
        }

        $shares = $allocation->shares()->sub($shares);

        $shares->isEmpty()
            ? $portfolio->deleteAllocationById($allocation->id())
            : $allocation->update($shares);

        $this->portfolioRepository->save($portfolio);
    }
}