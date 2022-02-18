<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\View\Order;

use App\FinizensContext\Domain\Model\Order\Order;
use App\SharedContext\Domain\View\ViewFactory;

class OrderViewFactory extends ViewFactory
{
    public static function create(Order $order): OrderView
    {
        return new OrderView(
            $order->id()->value(),
            $order->type()->value(),
            $order->status()->value(),
            $order->portfolioId()->value(),
            $order->allocationId()->value(),
            $order->shares()->value(),
        );
    }
}