<?php

declare(strict_types=1);

namespace App\FinizensContext\Infrastructure\Validator\Order;

use App\FinizensContext\Application\Command\Order\CreateOrder;
use App\FinizensContext\Domain\Model\Order\Order;
use App\FinizensContext\Domain\Model\Portfolio\Portfolio;
use App\FinizensContext\Domain\ValueObject\Allocation\AllocationId;
use App\FinizensContext\Domain\ValueObject\Allocation\Shares;
use App\FinizensContext\Domain\ValueObject\Order\OrderId;
use App\FinizensContext\Domain\ValueObject\Order\OrderType;
use App\FinizensContext\Domain\ValueObject\Portfolio\PortfolioId;
use App\SharedContext\Infrastructure\Validator\Constraints\EntityExist;
use App\SharedContext\Infrastructure\Validator\Constraints\EntityNotExist;
use App\SharedContext\Infrastructure\Validator\Constraints\ValueObjectConstraint;
use App\SharedContext\Infrastructure\Validator\ConstraintsBag;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class CreateOrderConstraints extends ConstraintsBag
{
    protected static function fields(): array
    {
        return [
            CreateOrder::ORDER_ID => [
                new NotNull(),
                new NotBlank(),
                new ValueObjectConstraint([
                    'entityClass' => OrderId::class,
                    'message' => 'invalid_order_id',
                ]),
                new EntityNotExist([
                    'entityClass' => Order::class,
                    'message' => 'order_already_exist',
                ]),
            ],
            CreateOrder::ORDER_TYPE => [
                new NotNull(),
                new NotBlank(),
                new ValueObjectConstraint([
                    'entityClass' => OrderType::class,
                    'message' => 'invalid_order_type',
                ]),
            ],
            CreateOrder::PORTFOLIO_ID => [
                new NotNull(),
                new NotBlank(),
                new ValueObjectConstraint([
                    'entityClass' => PortfolioId::class,
                    'message' => 'invalid_portfolio_id',
                ]),
                new EntityExist([
                    'entityClass' => Portfolio::class,
                    'message' => 'portfolio_not_exist',
                ]),
            ],
            CreateOrder::ALLOCATION_ID => [
                new NotNull(),
                new NotBlank(),
                new ValueObjectConstraint([
                    'entityClass' => AllocationId::class,
                    'message' => 'invalid_allocation_id',
                ]),
                /*new EntityExist([
                    'entityClass' => Allocation::class,
                    'message' => 'allocation_not_exist',
                ]),*/
            ],
            CreateOrder::SHARES => [
                new NotNull(),
                new NotBlank(),
                new ValueObjectConstraint([
                    'entityClass' => Shares::class,
                    'message' => 'invalid_shares',
                ]),
            ],
        ];
    }
}