<?php

declare(strict_types=1);

namespace App\IndContext\CheatMealModule\Application\Command;

use App\IndContext\CheatMealModule\Domain\Exception\ChealMeatIsAlreadyCreatedException;
use App\IndContext\CheatMealModule\Domain\Model\CheatMeal;
use App\IndContext\CheatMealModule\Domain\Repository\CheatMealRepository;
use App\IndContext\CheatMealModule\Domain\ValueObject\CheatMealId;
use App\IndContext\MealModule\Domain\Repository\MealRepository;
use App\SharedContext\Application\Command\CommandHandler;

class CreateChealMealHandler extends CommandHandler
{
    public function __construct(
        private MealRepository $mealRepository,
        private CheatMealRepository $cheatMealRepository,
    ) {
    }

    public function handle(CreateCheatMealCommand $command): void
    {
        $meal = $this->mealRepository->findOrFail($command->mealId());

        $cheatMeal = $this->cheatMealRepository->findByWeekAndYear(
            $command->weekNumber(),
            $command->year()
        );

        if (null !== $cheatMeal) {
            throw new ChealMeatIsAlreadyCreatedException($cheatMeal->id()->value());
        }

        $cheatMeal = new CheatMeal(
            CheatMealId::generate(),
            $meal,
            $command->weekDay(),
            $command->weekNumber(),
            $command->year(),
        );

        $this->cheatMealRepository->save($cheatMeal);
    }
}
