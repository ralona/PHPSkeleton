<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Infrastructure\Symfony;

use App\SharedContext\Infrastructure\Symfony\Extension;

class IndExtension extends Extension
{
    public function configPaths(): array
    {
        return [];
        $bundleDir = $this->bundleDir();
        return array_map(
            static fn(string $folderName) => $bundleDir . '/' . $folderName . '/Infrastructure/Symfony/config',
            scandir($bundleDir)
        );
    }

    public function bundleDir(): string
    {
        return dirname(__DIR__ . '/../../..');
    }
}
