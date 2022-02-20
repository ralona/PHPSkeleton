<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Application\Query;

use App\IndContext\MealModule\Domain\Repository\MealTemplateRepository;
use App\SharedContext\Application\Query\QueryHandlerInterface;
use App\SharedContext\Application\Query\QueryResponse;

class GetMealTemplateHandler implements QueryHandlerInterface
{
    public function __construct(
        private MealTemplateRepository $mealTemplateRepository
    ) {
    }

    public function handle(GetMealTemplatesQuery $query): QueryResponse
    {
        return new QueryResponse($this->mealTemplateRepository->all());
    }
}
