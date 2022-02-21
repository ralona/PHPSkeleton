<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Application\DTO;

use App\IndContext\MealModule\Domain\ValueObject\MealId;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\TimePeriod;

class MealScheduleDTO
{
    private const MEAL_ID = 'mealId';
    private const START_TIME = 'startTime';
    private const END_TIME = 'endTime';

    public function __construct(
        private MealId $mealId,
        private TimePeriod $schedule
    ) {
    }

    public static function fromArray(array $payload): self
    {
        return new self(
            new MealId($payload[self::MEAL_ID]),
            TimePeriod::deserialize(
                $payload[self::START_TIME],
                $payload[self::END_TIME],
            ),
        );
    }

    public function mealId(): MealId
    {
        return $this->mealId;
    }

    public function schedule(): TimePeriod
    {
        return $this->schedule;
    }
}
