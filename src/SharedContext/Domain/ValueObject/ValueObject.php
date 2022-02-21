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
        $value = is_array($value) ? $value : [$value];
        if (!static::isValid(...$value)) {
            throw $this->resolveException($value);
        }
    }

    private function resolveException($invalidValue): ValueObjectException
    {
        $exceptionClass = new ReflectionClass($this->invalidExceptionClass());
        $invalidValue = is_array($invalidValue) ? json_encode($invalidValue) : $invalidValue;
        $exception = $exceptionClass->newInstance($invalidValue);

        if (!$exception instanceof ValueObjectException) {
            throw new RuntimeException(get_class($exception));
        }

        return $exception;
    }
}