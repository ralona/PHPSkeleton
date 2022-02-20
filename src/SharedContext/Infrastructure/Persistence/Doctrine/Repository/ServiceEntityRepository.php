<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;

class ServiceEntityRepository extends EntityRepository
{
    public function exist($entityId, $alias = 'entity'): bool
    {
        $queryBuilder = $this->createQueryBuilder($alias)
            ->select("$alias.id")
            ->andWhere("$alias.id = :entityId")
            ->setParameter('entityId', $entityId);

        return null !== $queryBuilder->getQuery()->getOneOrNullResult();
    }
}
