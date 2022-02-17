<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Bus;

use League\Tactician\CommandBus as TacticianBus;

class TacticianCommandBus implements CommandBus
{
    private TacticianBus $tacticianBus;

    public function __construct(TacticianBus $tacticianBus)
    {
        $this->tacticianBus = $tacticianBus;
    }

    public function handle($command): void
    {
        $this->tacticianBus->handle($command);
    }
}
