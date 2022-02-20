<?php

declare(strict_types=1);

namespace App\SharedContext\Domain\Utils;

class ArrayUtils
{
    public static function searchBy(array $data, callable $function): array
    {
        return array_filter($data, $function);
    }

    public static function isInArray(array $data, callable $function): bool
    {
        return empty(self::searchBy($data, $function));
    }

    public static function findBy(array $data, callable $function): mixed
    {
        return current(array_filter($data, $function));
    }
}