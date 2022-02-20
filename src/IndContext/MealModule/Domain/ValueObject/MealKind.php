<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Domain\ValueObject;

use App\IndContext\MealModule\Domain\Exception\InvalidMealKindException;
use App\SharedContext\Domain\ValueObject\Generic\EnumValueObject;

/** @method equals(self $valueObject) */
class MealKind extends EnumValueObject
{
    private const BREAKFAST = 'breakfast';
    private const BRUNCH = 'brunch';
    private const ELEVENSES = 'elevenses';
    private const LUNCH = 'lunch';
    private const TEA = 'tea';
    private const SUPPER = 'supper';
    private const DINNER = 'dinner';

    protected function invalidExceptionClass(): string
    {
        return InvalidMealKindException::class;
    }

    public static function breakfast(): self
    {
        return new self(self::BREAKFAST);
    }

    public static function brunch(): self
    {
        return new self(self::BRUNCH);
    }

    public static function elevenses(): self
    {
        return new self(self::ELEVENSES);
    }

    public static function lunch(): self
    {
        return new self(self::LUNCH);
    }

    public static function tea(): self
    {
        return new self(self::TEA);
    }

    public static function supper(): self
    {
        return new self(self::SUPPER);
    }

    public static function dinner(): self
    {
        return new self(self::DINNER);
    }

    public function isBreakfast(): bool
    {
        return $this->value === self::BREAKFAST;
    }

    public function isBrunch(): bool
    {
        return $this->value === self::BRUNCH;
    }

    public function isElevenses(): bool
    {
        return $this->value === self::ELEVENSES;
    }

    public function isLunch(): bool
    {
        return $this->value === self::LUNCH;
    }

    public function isTea(): bool
    {
        return $this->value === self::TEA;
    }

    public function isSupper(): bool
    {
        return $this->value === self::SUPPER;
    }

    public function isDinner(): bool
    {
        return $this->value === self::DINNER;
    }
}
