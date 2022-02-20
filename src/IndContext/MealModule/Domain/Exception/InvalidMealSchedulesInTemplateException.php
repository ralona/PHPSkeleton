<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Domain\Exception;

use App\IndContext\MealModule\Domain\Model\MealTemplate;
use App\SharedContext\Domain\Exception\DomainException;

class InvalidMealSchedulesInTemplateException extends DomainException
{
    public static function create(MealTemplate $mealTemplate, int $schedulesCount): self
    {
        $message = sprintf('Expected %d schedules. %d arrived.', $mealTemplate->mealsCount(), $schedulesCount);
        return new self($message);
    }
}
