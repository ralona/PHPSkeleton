<?php

declare(strict_types=1);

namespace App\FinizensContext\Application\Command\Order;

use App\FinizensContext\Domain\ValueObject\Allocation\AllocationId;
use App\FinizensContext\Domain\ValueObject\Allocation\Shares;
use App\FinizensContext\Domain\ValueObject\Order\OrderId;
use App\FinizensContext\Domain\ValueObject\Order\OrderType;
use App\FinizensContext\Domain\ValueObject\Portfolio\PortfolioId;
use App\SharedContext\Application\Command\Command;

class CreateOrder extends Command
{
    public const ORDER_ID = 'id';
    public const ORDER_TYPE = 'type';
    public const PORTFOLIO_ID = 'portfolio';
    public const ALLOCATION_ID = 'allocation';
    public const SHARES = 'shares';

    private int $orderId;
    private string $orderType;
    private int $portfolioId;
    private int $allocationId;
    private int $shares;

    public function __construct(
        int $orderId,
        string $orderType,
        int $portfolioId,
        int $allocationId,
        int $shares,
    ) {
        $this->orderId = $orderId;
        $this->orderType = $orderType;
        $this->portfolioId = $portfolioId;
        $this->allocationId = $allocationId;
        $this->shares = $shares;
    }

    public function orderId(): OrderId
    {
        return new OrderId($this->orderId);
    }

    public function orderType(): OrderType
    {
        return new OrderType($this->orderType);
    }

    public function portfolioId(): PortfolioId
    {
        return new PortfolioId($this->portfolioId);
    }

    public function allocationId(): AllocationId
    {
        return new AllocationId($this->allocationId);
    }

    public function shares(): Shares
    {
        return new Shares($this->shares);
    }
}
