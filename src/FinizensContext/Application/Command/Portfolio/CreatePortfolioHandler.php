<?php

declare(strict_types=1);

namespace App\FinizensContext\Application\Command\Portfolio;

use App\FinizensContext\Domain\Model\Portfolio\Allocation;
use App\FinizensContext\Domain\Model\Portfolio\Portfolio;
use App\FinizensContext\Domain\Repository\Portfolio\PortfolioRepository;
use App\SharedContext\Application\Command\CommandHandler;

class CreatePortfolioHandler extends CommandHandler
{
    private PortfolioRepository $portfolioRepository;

    public function __construct(PortfolioRepository $portfolioRepository)
    {
        $this->portfolioRepository = $portfolioRepository;
    }

    public function handle(CreatePortfolio $command): void
    {
        $portfolio = new Portfolio($command->portfolioId());

        foreach ($command->allocations() as $allocationData) {
            $allocation = new Allocation(
                $allocationData['id'],
                $portfolio,
                $allocationData['shares'],
            );

            $portfolio->addAllocation($allocation);
        }

        $this->portfolioRepository->save($portfolio);
    }
}