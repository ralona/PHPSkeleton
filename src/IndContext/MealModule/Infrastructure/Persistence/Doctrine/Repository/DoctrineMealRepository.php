<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Infrastructure\Persistence\Doctrine\Repository;

use App\IndContext\MealModule\Domain\Exception\MealNotFoundException;
use App\IndContext\MealModule\Domain\Model\Meal;
use App\IndContext\MealModule\Domain\Repository\MealRepository;
use App\IndContext\MealModule\Domain\ValueObject\MealId;
use App\SharedContext\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;

class DoctrineMealRepository extends BaseRepository implements MealRepository
{
    protected function entityClassName(): string
    {
        return Meal::class;
    }

    public function find(MealId $mealId): ?Meal
    {
        return $this->repository->find($mealId);
    }

    public function findOrFail(MealId $mealId): Meal
    {
        $meal = $this->repository->find($mealId);
        if (null === $meal) {
            throw new MealNotFoundException($mealId->value());
        }

        return $meal;
    }

    public function save(Meal $meal): void
    {
        $this->_em->persist($meal);
    }

    public function delete(Meal $meal): void
    {
        $this->_em->remove($meal);
    }

    public function findByIds(MealId ...$mealIds): array
    {
        $queryBuilder = $this->createQueryBuilder()
            ->andWhere($this->alias() . '.id IN (:mealIds)')
            ->setParameter('mealIds', $mealIds);

        return $queryBuilder->getQuery()->getResult();
    }
}
