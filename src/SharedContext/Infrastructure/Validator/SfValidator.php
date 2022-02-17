<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Validator;

use App\SharedContext\Domain\Validator\Validator;
use App\SharedContext\Infrastructure\Exception\ValidationException;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SfValidator implements Validator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(array $data, array $constraints, int $code = 400): void
    {
        $data = $this->addToNull($data, $constraints);
        /** @var ConstraintViolationList $violations */
        $violations = $this->validator->validate($data, $constraints);

        if ($violations->count()) {
            throw new ValidationException($code);
        }
    }

    private function addToNull(array &$data, array $constraints): array
    {
        foreach ($constraints as $constraint) {
            if (!$constraint instanceof Collection) {
                continue;
            }

            foreach (array_keys($constraint->fields) as $field) {
                $data[$field] = $data[$field] ?? null;
            }
        }

        return $data;
    }
}