<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Application\Query;

use App\IndContext\MealModule\Domain\Model\MealTemplate;
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
        $mealTemplates = $this->mealTemplateRepository->all();
        $mealTemplateViews = array_map(
            static function (MealTemplate $mealTemplate) {
                $mealTemplateView = [
                    'mealTemplateId' => $mealTemplate->id()->value(),
                    'meals' => []
                ];

                foreach ($mealTemplate->meals() as $meal) {
                    $mealTemplateView['meals'][] = [
                        'id' => $meal->id()->value(),
                        'kind' => $meal->kind()->value(),
                    ];
                }

                return $mealTemplateView;
            },
            $mealTemplates
        );

        return new QueryResponse($mealTemplateViews);
    }
}
