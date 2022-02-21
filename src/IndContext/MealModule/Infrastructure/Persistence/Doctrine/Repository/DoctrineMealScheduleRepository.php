<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Infrastructure\Persistence\Doctrine\Repository;

use App\IndContext\MealModule\Domain\Model\MealSchedule;
use App\IndContext\MealModule\Domain\Repository\MealScheduleRepository;
use App\SharedContext\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;

class DoctrineMealScheduleRepository extends BaseRepository implements MealScheduleRepository
{
    protected function entityClassName(): string
    {
        return MealSchedule::class;
    }

    public function save(MealSchedule $mealSchedule): void
    {
        $this->_em->persist($mealSchedule);
    }

    public function all(): array
    {
        $queryBuilder = $this->createQueryBuilder()
            ->addOrderBy($this->alias() . '.timePeriod.startTime.hours', 'ASC')
            ->addOrderBy($this->alias() . '.timePeriod.startTime.minutes', 'ASC')
            ->addOrderBy($this->alias() . '.timePeriod.startTime.seconds', 'ASC');

        return $queryBuilder->getQuery()->getResult();
    }
}
