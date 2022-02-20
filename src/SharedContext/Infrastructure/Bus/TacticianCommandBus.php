<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Bus;

use App\SharedContext\Application\Command\Command;
use League\Tactician\CommandBus as TacticianBus;

class TacticianCommandBus implements CommandBus
{
    public function __construct(
        private TacticianBus $tacticianBus,
    ) {
    }

    public function handle(Command $command): void
    {
        $this->tacticianBus->handle($command);
    }
}
