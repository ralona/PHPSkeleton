<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class EntityExist extends Constraint
{
    public $entityClass;
    public $message = 'entity_exist';
}