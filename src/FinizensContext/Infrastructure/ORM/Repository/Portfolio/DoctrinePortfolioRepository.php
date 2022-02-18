<?php

declare(strict_types=1);

namespace App\FinizensContext\Infrastructure\ORM\Repository\Portfolio;

use App\FinizensContext\Domain\Model\Portfolio\Portfolio;
use App\FinizensContext\Domain\Repository\Portfolio\PortfolioRepository;
use App\FinizensContext\Domain\ValueObject\Portfolio\PortfolioId;
use App\SharedContext\Infrastructure\ORM\Repository\ServiceEntityRepository;

class DoctrinePortfolioRepository extends ServiceEntityRepository implements PortfolioRepository
{
    public static function entityClassName(): string
    {
        return Portfolio::class;
    }

    public function byId(PortfolioId $portfolioId): ?Portfolio
    {
        return $this->find($portfolioId->value());
    }

    public function all(): array
    {
        return $this->findAll();
    }

    public function save(Portfolio $portfolio): void
    {
        $this->_em->persist($portfolio);
    }
}