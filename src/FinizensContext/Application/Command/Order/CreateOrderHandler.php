<?php

declare(strict_types=1);

namespace App\FinizensContext\Application\Command\Order;

use App\FinizensContext\Domain\Exception\Allocation\AllocationNotFoundException;
use App\FinizensContext\Domain\Exception\Allocation\InvalidAllocationSharesException;
use App\FinizensContext\Domain\Exception\Portfolio\PortfolioNotFoundException;
use App\FinizensContext\Domain\Model\Order\Order;
use App\FinizensContext\Domain\Repository\Order\OrderRepository;
use App\FinizensContext\Domain\Repository\Portfolio\PortfolioRepository;
use App\SharedContext\Application\Command\CommandHandler;

class CreateOrderHandler extends CommandHandler
{
    private OrderRepository $orderRepository;
    private PortfolioRepository $portfolioRepository;

    public function __construct(OrderRepository $orderRepository, PortfolioRepository $portfolioRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->portfolioRepository = $portfolioRepository;
    }

    public function handle(CreateOrder $command): void
    {
        $portfolio = $this->portfolioRepository->byId($command->portfolioId());
        if (null === $portfolio) {
            throw new PortfolioNotFoundException($command->portfolioId()->value());
        }

        if ($command->orderType()->isSell()) {
            $allocation = $portfolio->allocation($command->allocationId());
            if (null === $allocation) {
                throw new AllocationNotFoundException($command->allocationId()->__toString());
            }

            if ($allocation->shares()->value() < $command->shares()->value()) {
                throw new InvalidAllocationSharesException((string)$command->shares()->value());
            }
        }

        $order = new Order(
            $command->orderId(),
            $command->orderType(),
            $command->portfolioId(),
            $command->allocationId(),
            $command->shares(),
        );

        $this->orderRepository->save($order);
    }
}
