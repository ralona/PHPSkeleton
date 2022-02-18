<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\ValueObject\Order;

use App\FinizensContext\Domain\Exception\Order\InvalidOrderIdException;
use App\SharedContext\Domain\ValueObject\Generic\Id;

class OrderId extends Id
{
    protected function invalidExceptionClass(): string
    {
        return InvalidOrderIdException::class;
    }
}