<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Infrastructure\Persistence\Doctrine\Repository;

use App\IndContext\MealModule\Domain\Model\Meal;
use App\IndContext\MealModule\Domain\Repository\MealViewRepository;
use App\SharedContext\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;

class DoctrineMealViewRepository extends BaseRepository implements MealViewRepository
{
    public function entityClassName(): string
    {
        return Meal::class;
    }
}
