<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\Event\Order;

use App\FinizensContext\Domain\ValueObject\Order\OrderId;
use App\FinizensContext\Domain\ValueObject\Order\OrderType;
use App\SharedContext\Domain\Event\DomainEvent;

interface OrderEvent extends DomainEvent
{
    public function orderId(): OrderId;

    public function orderType(): OrderType;
}