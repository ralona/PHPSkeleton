<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Request;

use Symfony\Component\HttpFoundation\Exception\JsonException;
use Symfony\Component\HttpFoundation\RequestStack;

class Request
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function content(): array
    {
        try {
            return $this->requestStack->getCurrentRequest() ? $this->requestStack->getCurrentRequest()->toArray() : [];
        } catch (JsonException) {
            return [];
        }
    }

    public function params(): array
    {
        return $this->requestStack->getCurrentRequest()->query->all();
    }
}