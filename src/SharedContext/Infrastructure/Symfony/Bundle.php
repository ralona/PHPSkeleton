<?php

namespace App\SharedContext\Infrastructure\Symfony;

use Symfony\Component\HttpKernel\Bundle\Bundle as SymfonyBundle;

class Bundle extends SymfonyBundle
{
    public function getContainerExtension(): Extension
    {
        return new Extension();
    }
}