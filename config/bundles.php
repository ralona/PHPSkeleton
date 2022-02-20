<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    League\Tactician\Bundle\TacticianBundle::class => ['all' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
    App\SharedContext\Infrastructure\Symfony\Bundle::class => ['all' => true],
    App\IndContext\SharedModule\Infrastructure\Symfony\IndBundle::class => ['all' => true],
];
