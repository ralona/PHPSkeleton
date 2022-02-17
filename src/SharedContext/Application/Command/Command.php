<?php

declare(strict_types=1);

namespace App\SharedContext\Application\Command;

use ReflectionClass;

abstract class Command
{
    /** @return static */
    public static function fromArray(array $data): self
    {
        $orderedData = [];
        $constants = (new ReflectionClass(static::class))->getConstants();

        foreach ($constants as $constant) {
            if (!isset($data[$constant])) {
                continue;
            }

            $orderedData[] = $data[$constant];
        }

        return new static(... $orderedData);
    }
}