<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Infrastructure\Controller;

use App\IndContext\MealModule\Application\Command\CreateMealSchedulesCommand;
use App\IndContext\MealModule\Application\DTO\MealScheduleDTO;
use App\IndContext\MealModule\Domain\ValueObject\MealTemplateId;
use App\SharedContext\Domain\Exception\DomainException;
use App\SharedContext\Infrastructure\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MealScheduleController extends BaseController
{
    #[Route("/meal-schedules", methods: ["PUT"])]
    public function createMealSchedule(): Response
    {
        $requestContent = $this->request->content();

        $command = new CreateMealSchedulesCommand(
            new MealTemplateId($requestContent['mealTemplateId']),
            array_map(static function (array $data) {
                return MealScheduleDTO::fromArray($data);
            }, $requestContent['mealSchedules']),
        );

        try {
            $this->commandBus->handle($command);
        } catch (DomainException $exception) {
            return $this->responseFactory->fromException($exception);
        }

        return $this->responseFactory->emptyResponse();
    }
}
