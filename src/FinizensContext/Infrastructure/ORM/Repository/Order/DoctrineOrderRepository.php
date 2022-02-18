<?php

declare(strict_types=1);

namespace App\FinizensContext\Infrastructure\ORM\Repository\Order;

use App\FinizensContext\Domain\Model\Order\Order;
use App\FinizensContext\Domain\Repository\Order\OrderRepository;
use App\FinizensContext\Domain\ValueObject\Order\OrderId;
use App\SharedContext\Infrastructure\ORM\Repository\ServiceEntityRepository;

class DoctrineOrderRepository extends ServiceEntityRepository implements OrderRepository
{
    public static function entityClassName(): string
    {
        return Order::class;
    }

    public function byId(OrderId $orderId): ?Order
    {
        return $this->find($orderId->value());
    }

    public function all(): array
    {
        return $this->findAll();
    }

    public function save(Order $order): void
    {
        $this->_em->persist($order);
    }
}