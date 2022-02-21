<?php

declare(strict_types=1);

namespace App\IndContext\MealModule\Infrastructure\Persistence\Doctrine\Repository;

use App\IndContext\MealModule\Domain\Exception\MealTemplateNotFoundException;
use App\IndContext\MealModule\Domain\Model\MealTemplate;
use App\IndContext\MealModule\Domain\Repository\MealTemplateRepository;
use App\IndContext\MealModule\Domain\ValueObject\MealTemplateId;
use App\SharedContext\Infrastructure\Persistence\Doctrine\Repository\BaseRepository;

class DoctrineMealTemplateRepository extends BaseRepository implements MealTemplateRepository
{
    protected function entityClassName(): string
    {
        return MealTemplate::class;
    }

    public function save(MealTemplate $mealTemplate): void
    {
        $this->_em->persist($mealTemplate);
    }

    public function delete(MealTemplate $mealTemplate): void
    {
        $this->_em->remove($mealTemplate);
    }

    public function find(MealTemplateId $mealTemplateId): ?MealTemplate
    {
        return $this->repository->find($mealTemplateId);
    }

    public function findOrFail(MealTemplateId $mealTemplateId): MealTemplate
    {
        $mealTemplate = $this->find($mealTemplateId);
        if (null === $mealTemplate) {
            throw new MealTemplateNotFoundException($mealTemplateId->value());
        }

        return $mealTemplate;
    }

    public function all(): array
    {
        return $this->repository->findAll();
    }
}
