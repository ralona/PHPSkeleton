<?php

namespace App\SharedContext\Domain\Validator;

interface Validator
{
    public function validate(array $data, array $constraints, int $code = 400): void;
}