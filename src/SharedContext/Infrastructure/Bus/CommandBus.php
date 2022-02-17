<?php

namespace App\SharedContext\Infrastructure\Bus;

interface CommandBus
{
    public function handle($command): void;
}