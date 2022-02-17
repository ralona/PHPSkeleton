<?php

declare(strict_types=1);

namespace App\SharedContext\Application\Command;

abstract class CommandHandler implements CommandHandlerInterface
{
    #abstract public function handle(Command $command): void;
}