<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Application\Command;

use App\IndContext\MealModule\Application\DTO\MealScheduleDTO;
use App\IndContext\MealModule\Domain\ValueObject\MealTemplateId;
use App\SharedContext\Application\Command\Command;

class CreateMealSchedulesCommand extends Command
{
    public function __construct(
        private MealTemplateId $mealTemplateId,
        private array $mealSchedules
    ) {
    }

    public function mealTemplateId(): MealTemplateId
    {
        return $this->mealTemplateId;
    }

    /** @return MealScheduleDTO[] */
    public function mealSchedules(): array
    {
        return $this->mealSchedules;
    }
}
