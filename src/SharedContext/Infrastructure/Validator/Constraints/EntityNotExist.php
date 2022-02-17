<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class EntityNotExist extends Constraint
{
    public $entityClass;
    public $message = 'entity_not_exist';
}