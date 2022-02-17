<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Validator\Constraints;

use App\SharedContext\Domain\ValueObject\ValueObject;
use ReflectionClass;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValueObjectConstraintValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof ValueObjectConstraint) {
            return;
        }

        if (null === $value) {
            return;
        }

        $voClass = (new ReflectionClass($constraint->entityClass))->newInstanceWithoutConstructor();

        if (!$voClass instanceof ValueObject) {
            return;
        }

        if ($voClass::isValid($value)) {
            return;
        }

        $this->context->buildViolation($constraint->message)->addViolation();
    }
}