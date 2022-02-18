<?php

declare(strict_types=1);

namespace App\FinizensContext\Application\Command\Portfolio;

use App\FinizensContext\Domain\ValueObject\Allocation\AllocationId;
use App\FinizensContext\Domain\ValueObject\Allocation\Shares;
use App\FinizensContext\Domain\ValueObject\Portfolio\PortfolioId;
use App\SharedContext\Application\Command\Command;

class CreatePortfolio extends Command
{
    public const PORTFOLIO_ID = 'id';
    public const ALLOCATIONS = 'allocations';
    public const ALLOCATION_ID = 'id';
    public const ALLOCATION_SHARES = 'shares';

    private int $portfolioId;
    private array $allocations;

    public function __construct(
        int $portfolioId,
        array $allocations,
    ) {
        $this->portfolioId = $portfolioId;
        $this->allocations = $allocations;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data[self::PORTFOLIO_ID],
            $data[self::ALLOCATIONS],
        );
    }

    public function portfolioId(): PortfolioId
    {
        return new PortfolioId($this->portfolioId);
    }

    public function allocations(): array
    {
        return array_map(static function (array $data) {
            return [
                'id' => new AllocationId($data['id']),
                'shares' => new Shares($data['shares']),
            ];
        }, $this->allocations);
    }
}
