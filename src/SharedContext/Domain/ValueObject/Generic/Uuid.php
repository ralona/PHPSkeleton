<?php

declare(strict_types=1);

namespace App\SharedContext\Domain\ValueObject\Generic;

use App\SharedContext\Domain\Exception\Uuid\InvalidUuidException;
use App\SharedContext\Domain\ValueObject\SimpleValueObject;
use Ramsey\Uuid\Uuid as RamseyUuid;

/** @property string $value */
class Uuid extends SimpleValueObject
{
    protected function invalidExceptionClass(): string
    {
        return InvalidUuidException::class;
    }

    public static function isValid(string $value): bool
    {
        return RamseyUuid::isValid($value);
    }

    public static function generate(): static
    {
        return new static(RamseyUuid::uuid4()->toString());
    }
}
