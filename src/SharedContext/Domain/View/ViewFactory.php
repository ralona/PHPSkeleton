<?php

declare(strict_types=1);

namespace App\SharedContext\Domain\View;

abstract class ViewFactory implements ViewFactoryInterface
{
    public static function makeCollection(array $items): array
    {
        return array_map(static function ($item) {
            return is_array($item) ? static::create(... array_values($item)) : static::create($item);
        }, $items);
    }
}
