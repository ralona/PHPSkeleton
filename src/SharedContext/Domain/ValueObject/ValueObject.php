<?php

declare(strict_types=1);

namespace App\SharedContext\Domain\ValueObject;

use App\SharedContext\Domain\Exception\ValueObjectException;
use ReflectionClass;
use RuntimeException;

abstract class ValueObject implements ValueObjectInterface
{
    abstract protected function invalidExceptionClass(): string;

    public function validate($value): void
    {
        if (!static::isValid($value)) {
            throw $this->resolveException($value);
        }
    }

    private function resolveException($invalidValue): ValueObjectException
    {
        $exceptionClass = new ReflectionClass($this->invalidExceptionClass());
        $exception = $exceptionClass->newInstance($invalidValue);

        if (!$exception instanceof ValueObjectException) {
            throw new RuntimeException(get_class($exception));
        }

        return $exception;
    }
}