<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Domain\ValueObject\Schedule;

use App\IndContext\SharedModule\Domain\Exception\Schedule\InvalidTimeException;
use App\SharedContext\Domain\ValueObject\ValueObject;

class Time extends ValueObject
{
    private string $hours;
    private string $minutes;
    private string $seconds;

    public function __construct(string $value)
    {
        $this->validate($value);
        [$this->hours, $this->minutes, $this->seconds] = explode(':', $value);
    }

    public static function create(string $value): self
    {
        $data = explode(':', $value);
        for ($i = count($data); $i < 3; $i++) {
            $value .= ':00';
        }

        return new self($value);
    }

    protected function invalidExceptionClass(): string
    {
        return InvalidTimeException::class;
    }

    public static function isValid(string $value): bool
    {
        if (preg_match('/(?:[01]\d|2[0-3]):(?:[0-5]\d):(?:[0-5]\d)/', $value)) {
            return true;
        }

        return false;
    }

    public function hours(): string
    {
        return $this->hours;
    }

    public function minutes(): string
    {
        return $this->minutes;
    }

    public function seconds(): string
    {
        return $this->seconds;
    }

    public function isLessThan(Time $time): bool
    {
        if ($time->hours > $this->hours) {
            return false;
        }

        if ($time->minutes > $this->minutes) {
            return false;
        }

        if ($time->seconds > $this->seconds) {
            return false;
        }

        return true;
    }

    public function isMoreThan(Time $time): bool
    {
        if ($this->hours > $time->hours) {
            return false;
        }

        if ($this->minutes > $time->minutes) {
            return false;
        }

        if ($this->seconds > $time->seconds) {
            return false;
        }

        return true;
    }

    public function value(): string
    {
        return $this->hours . '.' . $this->minutes . '.' . $this->seconds;
    }
}
