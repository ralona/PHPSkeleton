<?php

namespace App\SharedContext\Infrastructure\Symfony;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension as SymfonyExtension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Extension extends SymfonyExtension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $this->loadBundle($container);
    }

    /** @throws Exception */
    public function loadBundle(ContainerBuilder $container): void
    {
        $configPath = __DIR__ . '/../Symfony/config';
        $loader = new YamlFileLoader($container, new FileLocator($configPath));

        $ymlFilenames = array_filter(scandir($configPath), static function ($filename) {
            return preg_match('/\.(?:yml|yaml)$/', $filename);
        });

        foreach ($ymlFilenames as $filename) {
            $loader->load($configPath . '/' . $filename);
        }
    }
}