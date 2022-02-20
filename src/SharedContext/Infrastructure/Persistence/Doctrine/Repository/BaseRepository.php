<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;

abstract class BaseRepository
{
    protected ServiceEntityRepository $repository;
    private ClassMetadata $classMetadata;

    public function __construct(
        protected EntityManager $_em
    ) {
        $this->classMetadata = new ClassMetadata($this->entityClassName());
        $this->repository = new ServiceEntityRepository($_em, $this->classMetadata);
    }

    abstract protected function entityClassName(): string;

    protected function alias(): string
    {
        return $this->classMetadata->name;
    }

    protected function createQueryBuilder(): QueryBuilder
    {
        return $this->repository->createQueryBuilder($this->alias());
    }
}
