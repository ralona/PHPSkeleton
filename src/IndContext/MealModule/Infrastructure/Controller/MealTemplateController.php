<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Infrastructure\Controller;

use App\IndContext\MealModule\Application\Query\GetMealTemplatesQuery;
use App\SharedContext\Infrastructure\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MealTemplateController extends BaseController
{
    #[Route("/meal-templates", methods: ["GET"])]
    public function getMealTemplates(): Response
    {
        $query = new GetMealTemplatesQuery();

        $queryResponse = $this->queryBus->handle($query);

        return $this->responseFactory->fromQueryResponse($queryResponse);
    }
}
