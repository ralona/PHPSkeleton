<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\Event\Order;

use App\FinizensContext\Domain\ValueObject\Order\OrderId;
use App\FinizensContext\Domain\ValueObject\Order\OrderType;
use App\SharedContext\Domain\Event\BaseDomainEvent;

class OrderCreated extends BaseDomainEvent implements OrderEvent
{
    private string $orderId;
    private string $orderType;

    public function __construct(OrderId $orderId, OrderType $orderType)
    {
        parent::__construct();

        $this->orderId = $orderId->value();
        $this->orderType = $orderType->value();
    }

    public function orderId(): OrderId
    {
        return new OrderId($this->orderId);
    }

    public function orderType(): OrderType
    {
        return new OrderType($this->orderType);
    }
}