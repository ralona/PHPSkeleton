<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\Service\Portfolio;

use App\FinizensContext\Domain\Exception\Portfolio\PortfolioNotFoundException;
use App\FinizensContext\Domain\Model\Portfolio\Allocation;
use App\FinizensContext\Domain\Repository\Portfolio\PortfolioRepository;
use App\FinizensContext\Domain\ValueObject\Allocation\AllocationId;
use App\FinizensContext\Domain\ValueObject\Allocation\Shares;
use App\FinizensContext\Domain\ValueObject\Portfolio\PortfolioId;

class BuySharesService
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
            throw new PortfolioNotFoundException($portfolioId->value());
        }

        $allocation = $portfolio->allocation($allocationId);
        if (null === $allocation) {
            $allocation = new Allocation($allocationId, $portfolio, Shares::emptyShares());
            $portfolio->addAllocation($allocation);
        }

        $shares = $allocation->shares()->sum($shares);

        $allocation->update($shares);

        $this->portfolioRepository->save($portfolio);
    }

}