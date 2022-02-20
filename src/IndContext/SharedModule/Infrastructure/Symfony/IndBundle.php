<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Infrastructure\Symfony;

use App\SharedContext\Infrastructure\Symfony\Bundle;
use App\SharedContext\Infrastructure\Symfony\Extension;

class IndBundle extends Bundle
{
    public function getContainerExtension(): Extension
    {
        return new IndExtension();
    }
}
