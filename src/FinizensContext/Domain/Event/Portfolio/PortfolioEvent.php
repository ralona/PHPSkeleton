<?php

namespace App\FinizensContext\Domain\Event\Portfolio;

use App\FinizensContext\Domain\ValueObject\Portfolio\PortfolioId;
use App\SharedContext\Domain\Event\DomainEvent;

interface PortfolioEvent extends DomainEvent
{
    public function portfolioId(): PortfolioId;
}