<?php

declare(strict_types=1);

namespace App\IndContext\CheatMealModule\Infrastructure\Persistence\Doctrine\Repository;

use App\IndContext\CheatMealModule\Domain\Model\CheatMeal;
use App\IndContext\CheatMealModule\Domain\Repository\CheatMealRepository;
use App\IndContext\CheatMealModule\Domain\ValueObject\WeekNumber;
use App\IndContext\CheatMealModule\Domain\ValueObject\Year;
use App\SharedContext\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;

class DoctirneCheatMealRepository extends BaseRepository implements CheatMealRepository
{
    protected function entityClassName(): string
    {
        return CheatMeal::class;
    }

    public function save(CheatMeal $cheatMeal): void
    {
        $this->_em->persist($cheatMeal);
    }

    public function delete(CheatMeal $cheatMeal): void
    {
        $this->_em->remove($cheatMeal);
    }

    public function findByWeekAndYear(WeekNumber $weekNumber, Year $year): ?CheatMeal
    {
        $queryBuilder = $this->createQueryBuilder()
            ->andWhere($this->alias() . '.weekNumber.value = :weekNumber')
            ->andWhere($this->alias() . '.year.value = :year')
            ->setParameter('weekNumber', $weekNumber->value())
            ->setParameter('year', $year->value());

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    public function all(): array
    {
        return $this->repository->findAll();
    }
}
