<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\View\Order;

class OrderView
{
    public string $id;
    public string $orderType;
    public string $orderStatus;
    public string $portfolio;
    public string $allocation;
    public int $shares;

    public function __construct(
        string $orderId,
        string $orderType,
        string $orderStatus,
        string $portfolioId,
        string $allocationId,
        int $shares,
    ) {
        $this->id = $orderId;
        $this->orderType = $orderType;
        $this->orderStatus = $orderStatus;
        $this->portfolio = $portfolioId;
        $this->allocation = $allocationId;
        $this->shares = $shares;
    }

}