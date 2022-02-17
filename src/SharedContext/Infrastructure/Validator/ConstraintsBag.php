<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Collection;

abstract class ConstraintsBag
{
    protected static bool $allowExtraFields = true;
    protected static bool $allowMissingFields = false;
    protected static string $extraFieldsMessage = 'This field was not expected.';
    protected static string $missingFieldsMessage = 'This field is missing.';

    /** @return Constraint[] */
    protected static function general(): array
    {
        return [];
    }

    protected static function fields(): array
    {
        return [];
    }

    private static function properties(): Collection
    {
        return self::collectionByFields(static::fields());
    }

    protected static function collectionByFields(array $fieldConstraints): Collection
    {
        return new Collection([
            'fields' => $fieldConstraints,
            'allowExtraFields' => static::$allowExtraFields,
            'allowMissingFields' => static::$allowMissingFields,
            'extraFieldsMessage' => static::$extraFieldsMessage,
            'missingFieldsMessage' => static::$missingFieldsMessage,
        ]);
    }

    final public static function get(string ...$fields): array
    {
        if (empty($fields)) {
            return array_merge(
                static::general(),
                [static::properties()]
            );
        }

        $fieldConstraints = array_filter(static::fields(), static function (string $key) use ($fields) {
            return in_array($key, $fields, true);
        }, ARRAY_FILTER_USE_KEY);

        return [self::collectionByFields($fieldConstraints)];
    }

    final public static function withCustomFieldConstraints(array $fieldConstraints): array
    {
        return [self::collectionByFields($fieldConstraints)];
    }
}