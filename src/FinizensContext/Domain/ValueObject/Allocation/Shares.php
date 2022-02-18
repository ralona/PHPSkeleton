<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\ValueObject\Allocation;

use App\FinizensContext\Domain\Exception\Allocation\InvalidSharesException;
use App\SharedContext\Domain\ValueObject\SimpleValueObject;

class Shares extends SimpleValueObject
{
    protected function invalidExceptionClass(): string
    {
        return InvalidSharesException::class;
    }

    public static function isValid(mixed $value): bool
    {
        return is_int($value) && $value >= 0 && $value <= PHP_INT_MAX;
    }

    public function value(): int
    {
        return parent::value();
    }

    public static function emptyShares(): self
    {
        return new self(0);
    }

    public function isEmpty(): bool
    {
        return $this->value === 0;
    }

    public function sum(self $shares): self
    {
        return new self($this->value + $shares->value());
    }

    public function sub(self $shares): self
    {
        $newValue = $this->value - $shares->value();
        return $newValue <= 0 ? new self($newValue) : self::emptyShares();
    }
}