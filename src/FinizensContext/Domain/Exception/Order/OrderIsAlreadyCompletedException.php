<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\Exception\Order;

use App\SharedContext\Domain\Exception\DomainException;

class OrderIsAlreadyCompletedException extends DomainException
{

}