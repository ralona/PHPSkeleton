<?php

declare(strict_types=1);

namespace App\SharedContext\Domain\ValueObject;

abstract class SimpleValueObject extends ValueObject
{
    protected mixed $value;

    public function __construct($value)
    {
        $this->validate($value);

        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(self $valueObject): bool
    {
        return $valueObject instanceof static && $this->value === $valueObject->value();
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

}
