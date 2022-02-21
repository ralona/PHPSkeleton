<?php

declare(strict_types=1);

namespace App\IndContext\CheatMealModule\Infrastructure\Controller;

use App\IndContext\CheatMealModule\Application\Command\CreateCheatMealCommand;
use App\IndContext\CheatMealModule\Domain\ValueObject\WeekNumber;
use App\IndContext\CheatMealModule\Domain\ValueObject\Year;
use App\IndContext\MealModule\Domain\ValueObject\MealId;
use App\IndContext\SharedModule\Domain\ValueObject\Schedule\Weekday;
use App\SharedContext\Domain\Exception\DomainException;
use App\SharedContext\Infrastructure\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheatMealController extends BaseController
{
    #[Route("/cheat-meals", methods: ["PUT"])]
    public function createCheatMeal(): Response
    {
        $requestContent = $this->request->content();

        $commnad = new CreateCheatMealCommand(
            new MealId($requestContent['mealId']),
            new Weekday($requestContent['weekday']),
            new WeekNumber($requestContent['weekNumber']),
            new Year($requestContent['year']),
        );

        try {
            $this->commandBus->handle($commnad);
        } catch (DomainException $exception) {
            return $this->responseFactory->fromException($exception);
        }

        return $this->responseFactory->emptyResponse();
    }
}
