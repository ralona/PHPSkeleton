<?php

declare(strict_types=1);

namespace App\FinizensContext\Application\Command\Order;

use App\FinizensContext\Domain\Exception\Allocation\AllocationNotFoundException;
use App\FinizensContext\Domain\Exception\Order\OrderIsAlreadyCompletedException;
use App\FinizensContext\Domain\Exception\Order\OrderNotFoundException;
use App\FinizensContext\Domain\Exception\Portfolio\PortfolioNotFoundException;
use App\FinizensContext\Domain\Repository\Order\OrderRepository;
use App\FinizensContext\Domain\Service\Portfolio\BuySharesService;
use App\FinizensContext\Domain\Service\Portfolio\SellSharesService;
use App\SharedContext\Application\Command\CommandHandler;

class CompleteOrderHandler extends CommandHandler
{
    private OrderRepository $orderRepository;
    private BuySharesService $buySharesService;
    private SellSharesService $sellSharesService;

    public function __construct(
        OrderRepository $orderRepository,
        BuySharesService $buySharesService,
        SellSharesService $sellSharesService,
    ) {
        $this->orderRepository = $orderRepository;
        $this->buySharesService = $buySharesService;
        $this->sellSharesService = $sellSharesService;
    }

    /**
     * @throws AllocationNotFoundException
     * @throws PortfolioNotFoundException
     */
    public function handle(CompleteOrder $command): void
    {
        $order = $this->orderRepository->byId($command->orderId());
        if (null === $order) {
            throw new OrderNotFoundException($command->orderId()->value());
        }

        if ($order->status()->isComplete()) {
            throw new OrderIsAlreadyCompletedException($order->id()->value());
        }

        if ($order->type()->isBuy()) {
            $this->buySharesService->handle($order->portfolioId(), $order->allocationId(), $order->shares());
        }

        if ($order->type()->isSell()) {
            $this->sellSharesService->handle($order->portfolioId(), $order->allocationId(), $order->shares());
        }

        $order->markAsCompleted();

        $this->orderRepository->save($order);
    }
}
