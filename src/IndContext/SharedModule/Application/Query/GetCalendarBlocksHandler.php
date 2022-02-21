<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Application\Query;

use App\IndContext\CheatMealModule\Domain\Model\CheatMeal;
use App\IndContext\CheatMealModule\Domain\Repository\CheatMealRepository;
use App\IndContext\MealModule\Domain\Repository\MealScheduleRepository;
use App\IndContext\SharedModule\Application\Services\CalculateWorkoutSchedulesService;
use App\IndContext\SharedModule\Application\Services\CalulateMealSchedulesService;
use App\IndContext\SharedModule\Domain\View\Calendar\DayBlockView;
use App\IndContext\WorkoutModule\Domain\Repository\WorkoutScheduleRepository;
use App\SharedContext\Application\Query\QueryHandlerInterface;
use App\SharedContext\Application\Query\QueryResponse;
use Carbon\CarbonPeriod;

class GetCalendarBlocksHandler implements QueryHandlerInterface
{
    public function __construct(
        private MealScheduleRepository $mealScheduleRepository,
        private WorkoutScheduleRepository $workoutScheduleRepository,
        private CheatMealRepository $cheatMealRepository,
        private CalulateMealSchedulesService $calulateMealSchedulesService,
        private CalculateWorkoutSchedulesService $calculateWorkoutSchedulesService,
    ) {
    }

    public function handle(GetCalendarBlocksQuery $query): QueryResponse
    {
        $mealSchedules = $this->mealScheduleRepository->all();
        $workoutSchedules = $this->workoutScheduleRepository->all();
        $cheatMeals = $this->cheatMealRepository->all();

        $period = new CarbonPeriod($query->startDate(), $query->endDate());

        $calendar = [];
        foreach ($period as $date) {
            $cheatMeal = array_filter(
                    $cheatMeals,
                    static fn(CheatMeal $cheatMeal) => $date->dayOfWeek === $cheatMeal->weekday()->value() &&
                        $date->weekOfYear === $cheatMeal->weekNumber()->value() &&
                        $date->isSameYear((string)$cheatMeal->year()->value())
                )[0] ?? null;

            $calculatedWorkoutSchedules = ($this->calculateWorkoutSchedulesService)($date, ...$workoutSchedules);

            $calculatedMealSchedules = ($this->calulateMealSchedulesService)(
                $date,
                $mealSchedules,
                $cheatMeal,
                $calculatedWorkoutSchedules,
            );

            $calendar[] = new DayBlockView($date, ...
                array_merge($calculatedMealSchedules, $calculatedWorkoutSchedules));
        }

        return new QueryResponse($calendar);
    }
}
