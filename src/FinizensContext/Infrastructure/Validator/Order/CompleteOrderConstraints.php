<?php

declare(strict_types=1);

namespace App\FinizensContext\Infrastructure\Validator\Order;

use App\FinizensContext\Application\Command\Order\CompleteOrder;
use App\FinizensContext\Domain\Model\Order\Order;
use App\SharedContext\Infrastructure\Validator\Constraints\EntityExist;
use App\SharedContext\Infrastructure\Validator\ConstraintsBag;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class CompleteOrderConstraints extends ConstraintsBag
{
    protected static function fields(): array
    {
        return [
            CompleteOrder::ORDER_ID => [
                new NotNull(),
                new NotBlank(),
                new EntityExist([
                    'entityClass' => Order::class,
                    'message' => 'order_not_exist',
                ]),
            ],
        ];
    }
}