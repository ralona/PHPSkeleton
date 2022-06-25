<?php

declare(strict_types=1);

namespace App\SharedContext\Application\Bus;

use App\SharedContext\Application\Command\Command;

interface CommandBus
{
    public function handle(Command $command): void;
}