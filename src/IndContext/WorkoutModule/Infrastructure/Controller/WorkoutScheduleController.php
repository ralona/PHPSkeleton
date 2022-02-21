<?php

declare(strict_types=1);

namespace App\IndContext\WorkoutModule\Infrastructure\Controller;

use App\IndContext\SharedModule\Domain\ValueObject\Schedule\Time;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\TimePeriod;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\Weekday;
use App\IndContext\WorkoutModule\Application\Command\CreateWorkoutScheduleCommand;
use App\IndContext\WorkoutModule\Domain\ValueObject\WorkoutName;
use App\SharedContext\Infrastructure\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WorkoutScheduleController extends BaseController
{
    #[Route("/workout-schedules", methods: ["PUT"])]
    public function createWorkoutSchedules(): Response
    {
        $requestContent = $this->request->content();

        $command = new CreateWorkoutScheduleCommand(
            new WorkoutName($requestContent['workoutName']),
            new Weekday((int)$requestContent['weekday']),
            new TimePeriod(
                new Time($requestContent['startTime']),
                new Time($requestContent['endTime']),
            )
        );

        $this->commandBus->handle($command);

        return $this->responseFactory->emptyResponse();
    }
}
