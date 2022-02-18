<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\ValueObject\Order;

use App\FinizensContext\Domain\Exception\Order\InvalidOrderTypeException;
use App\SharedContext\Domain\ValueObject\Generic\StringValueObject;

class OrderType extends StringValueObject
{
    protected const BUY = 'buy';
    protected const SELL = 'sell';

    protected function invalidExceptionClass(): string
    {
        return InvalidOrderTypeException::class;
    }

    public static function buy(): self
    {
        return new self(self::BUY);
    }

    public static function sell(): self
    {
        return new self(self::SELL);
    }

    public function isBuy(): bool
    {
        return $this->value === self::BUY;
    }

    public function isSell(): bool
    {
        return $this->value === self::SELL;
    }
}