<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Domain\ValueObject\Schedule;

use App\IndContext\SharedModule\Domain\Exception\Schedule\InvalidTimeException;
use App\SharedContext\Domain\ValueObject\ValueObject;

class Time extends ValueObject
{
    private int $hours;
    private int $minutes;
    private int $seconds;

    public function __construct(string $value)
    {
        $data = explode(':', $value);
        for ($i = count($data); $i < 3; $i++) {
            $value .= ':00';
        }

        $this->validate($value);
        [$this->hours, $this->minutes, $this->seconds] = array_map(
            'intval',
            explode(':', $value)
        );
    }

    public static function create(string $value): self
    {
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
        if ($this->hours < $time->hours) {
            return true;
        }

        if ($this->hours > $time->hours) {
            return false;
        }

        if ($this->minutes < $time->minutes) {
            return true;
        }

        if ($this->minutes > $time->minutes) {
            return false;
        }

        if ($this->seconds < $time->seconds) {
            return true;
        }

        return false;
    }

    public function isMoreThan(Time $time): bool
    {
        if ($this->hours > $time->hours) {
            return true;
        }

        if ($this->hours < $time->hours) {
            return false;
        }

        if ($this->minutes > $time->minutes) {
            return true;
        }


        if ($this->minutes < $time->minutes) {
            return false;
        }

        if ($this->seconds > $time->seconds) {
            return true;
        }

        return false;
    }

    public function value(): string
    {
        return str_pad((string)$this->hours, 2, '0', STR_PAD_LEFT)
            . ':' .
            str_pad((string)$this->minutes, 2, '0', STR_PAD_LEFT)
            . ':' .
            str_pad((string)$this->seconds, 2, '0', STR_PAD_LEFT);
    }
}
