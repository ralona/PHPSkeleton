<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\ValueObject\Order;

use App\FinizensContext\Domain\Exception\Order\InvalidOrderStatusException;
use App\SharedContext\Domain\ValueObject\Generic\StringValueObject;

class OrderStatus extends StringValueObject
{
    protected const PENDING = 'pending';
    protected const COMPLETE = 'complete';

    protected function invalidExceptionClass(): string
    {
        return InvalidOrderStatusException::class;
    }

    public static function pending(): self
    {
        return new self(self::PENDING);
    }

    public static function complete(): self
    {
        return new self(self::COMPLETE);
    }

    public function isPending(): bool
    {
        return $this->value === self::PENDING;
    }

    public function isComplete(): bool
    {
        return $this->value === self::COMPLETE;
    }
}