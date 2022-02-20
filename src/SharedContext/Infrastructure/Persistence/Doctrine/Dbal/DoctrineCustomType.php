<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Persistence\Doctrine\Dbal;

interface DoctrineCustomType
{
    public static function customTypeName(): string;
}
