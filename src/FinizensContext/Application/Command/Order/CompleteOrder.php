<?php

declare(strict_types=1);

namespace App\FinizensContext\Application\Command\Order;

use App\FinizensContext\Domain\ValueObject\Order\OrderId;
use App\SharedContext\Application\Command\Command;

class CompleteOrder extends Command
{
    public const ORDER_ID = 'id';

    private int $orderId;

    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
    }

    public function orderId(): OrderId
    {
        return new OrderId($this->orderId);
    }
}