<?php

namespace App\SharedContext\Infrastructure\Symfony;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension as SymfonyExtension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Extension extends SymfonyExtension
{
    final public function load(array $configs, ContainerBuilder $container): void
    {
        foreach ($this->configPaths() as $configPath) {
            $loader = new YamlFileLoader($container, new FileLocator($configPath));
            $this->loadBundle($loader, $configPath);
        }
    }

    public function configPaths(): array
    {
        return [
            __DIR__ . '/config'
        ];
    }

    /** @throws Exception */
    final public function loadBundle(YamlFileLoader $loader, string $configPath): void
    {
        $ymlFilenames = array_filter(scandir($configPath), static function ($filename) {
            return preg_match('/\.(?:yml|yaml)$/', $filename);
        });

        foreach ($ymlFilenames as $filename) {
            $loader->load($configPath . '/' . $filename);
        }
    }
}