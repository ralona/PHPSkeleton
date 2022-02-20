<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Application\Command;

use App\IndContext\MealModule\Application\DTO\MealScheduleDTO;
use App\IndContext\MealModule\Domain\Exception\InvalidMealSchedulesInTemplateException;
use App\IndContext\MealModule\Domain\Model\Meal;
use App\IndContext\MealModule\Domain\Model\MealSchedule;
use App\IndContext\MealModule\Domain\Repository\MealRepository;
use App\IndContext\MealModule\Domain\Repository\MealScheduleRepository;
use App\IndContext\MealModule\Domain\Repository\MealTemplateRepository;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\ScheduleId;
use App\SharedContext\Application\Command\CommandHandler;
use App\SharedContext\Domain\Utils\ArrayUtils;

class CreateMealSchedulesHandler extends CommandHandler
{
    public function __construct(
        private MealTemplateRepository $mealTemplateRepository,
        private MealRepository $mealRepository,
        private MealScheduleRepository $mealScheduleRepository
    ) {
    }

    public function handle(CreateMealSchedulesCommand $command): void
    {
        $mealTemplate = $this->mealTemplateRepository->findOrFail($command->mealTemplateId());
        $mealSchedulesDTO = $command->mealSchedules();

        if ($mealTemplate->mealsCount() !== count($mealSchedulesDTO)) {
            throw InvalidMealSchedulesInTemplateException::create($mealTemplate, count($mealSchedulesDTO));
        }

        $mealIds = array_map(static function (MealScheduleDTO $dto) {
            return $dto->mealId();
        }, $mealSchedulesDTO);

        $meals = $this->mealRepository->findByIds(...$mealIds);

        foreach ($mealSchedulesDTO as $mealScheduleDTO) {
            $meal = ArrayUtils::findBy($meals, static function (Meal $meal) use ($mealScheduleDTO) {
                return $meal->id()->equals($mealScheduleDTO->mealId());
            });

            $mealSchedule = new MealSchedule(
                ScheduleId::generate(),
                $meal,
                $mealScheduleDTO->schedule(),
            );

            $this->mealScheduleRepository->save($mealSchedule);
        }
    }
}
