<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use function Lambdish\Phunctional\last;

abstract class BaseRepository
{
    protected ServiceEntityRepository $repository;
    private string $alias;

    public function __construct(
        protected EntityManagerInterface $_em
    ) {
        $this->alias = last(explode('\\', static::entityClassName()));
        $this->repository = new ServiceEntityRepository(
            $_em,
            $this->_em->getClassMetadata(static::entityClassName())
        );
    }

    abstract protected function entityClassName(): string;

    protected function alias(): string
    {
        return $this->alias;
    }

    protected function createQueryBuilder(): QueryBuilder
    {
        return $this->repository->createQueryBuilder($this->alias());
    }
}
