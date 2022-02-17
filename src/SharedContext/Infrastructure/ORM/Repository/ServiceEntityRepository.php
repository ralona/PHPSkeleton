<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\ORM\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository as DoctrineServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

abstract class ServiceEntityRepository extends DoctrineServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, static::entityClassName());
    }

    abstract public static function entityClassName(): string;
}