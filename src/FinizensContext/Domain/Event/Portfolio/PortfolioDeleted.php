<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\Event\Portfolio;

use App\FinizensContext\Domain\ValueObject\Portfolio\PortfolioId;
use App\SharedContext\Domain\Event\BaseDomainEvent;

class PortfolioDeleted extends BaseDomainEvent implements PortfolioEvent
{
    private string $portfolioId;

    public function __construct(PortfolioId $portfolioId)
    {
        parent::__construct();

        $this->portfolioId = $portfolioId->value();
    }

    public function portfolioId(): PortfolioId
    {
        return new PortfolioId($this->portfolioId);
    }
}