<?php

declare(strict_types=1);

namespace App\FinizensContext\Infrastructure\Validator\Portfolio;

use App\FinizensContext\Application\Command\Portfolio\CreatePortfolio;
use App\FinizensContext\Domain\Model\Portfolio\Allocation;
use App\FinizensContext\Domain\Model\Portfolio\Portfolio;
use App\FinizensContext\Domain\ValueObject\Allocation\AllocationId;
use App\FinizensContext\Domain\ValueObject\Allocation\Shares;
use App\FinizensContext\Domain\ValueObject\Portfolio\PortfolioId;
use App\SharedContext\Infrastructure\Validator\Constraints\EntityNotExist;
use App\SharedContext\Infrastructure\Validator\Constraints\ValueObjectConstraint;
use App\SharedContext\Infrastructure\Validator\ConstraintsBag;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class CreatePortfolioConstraints extends ConstraintsBag
{
    protected static function fields(): array
    {
        return [
            CreatePortfolio::PORTFOLIO_ID => [
                new NotNull(),
                new NotBlank(),
                new ValueObjectConstraint([
                    'entityClass' => PortfolioId::class,
                    'message' => 'invalid_id'
                ]),
                new EntityNotExist([
                    'entityClass' => Portfolio::class,
                    'message' => 'portfolio_already_exist',
                ]),
            ],
            CreatePortfolio::ALLOCATIONS => [
                new Type([
                    'type' => 'array',
                    'message' => 'invalid_type'
                ]),
                new All([
                    self::collectionByFields([
                        CreatePortfolio::ALLOCATION_ID => [
                            new NotNull(),
                            new NotBlank(),
                            new ValueObjectConstraint([
                                'entityClass' => AllocationId::class,
                                'message' => 'invalid_id'
                            ]),
                            new EntityNotExist([
                                'entityClass' => Allocation::class,
                                'message' => 'allocation_already_exist',
                            ]),
                        ],
                        CreatePortfolio::ALLOCATION_SHARES => [
                            new NotNull(),
                            new ValueObjectConstraint([
                                'entityClass' => Shares::class,
                                'message' => 'invalid_shares'
                            ]),
                        ],
                    ]),
                ]),
            ],
        ];
    }
}