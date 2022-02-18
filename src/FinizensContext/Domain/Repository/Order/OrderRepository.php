<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\Repository\Order;

use App\FinizensContext\Domain\Model\Order\Order;
use App\FinizensContext\Domain\ValueObject\Order\OrderId;

interface OrderRepository
{
    public function byId(OrderId $orderId): ?Order;

    /** @return Order[] */
    public function all(): array;

    public function save(Order $order): void;
}