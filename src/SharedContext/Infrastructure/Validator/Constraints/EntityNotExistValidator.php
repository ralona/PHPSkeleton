<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Validator\Constraints;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EntityNotExistValidator extends ConstraintValidator
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof EntityNotExist) {
            return;
        }

        if (null === $value) {
            return;
        }

        $entity = $this->entityManager->find($constraint->entityClass, $value);
        if (null === $entity) {
            return;
        }

        $this->context->buildViolation($constraint->message)->addViolation();
    }
}