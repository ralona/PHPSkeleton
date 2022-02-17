<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Exception;

use RuntimeException;

class ValidationException extends RuntimeException
{
    public function __construct(int $code = 400)
    {
        $message = 'The given data failed to pass validation.';

        parent::__construct($message, $code);
    }
}