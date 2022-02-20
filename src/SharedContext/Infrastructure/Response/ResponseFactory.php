<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Response;

use App\SharedContext\Application\Query\QueryResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ResponseFactory
{
    public function emptyResponse(int $code = 200): Response
    {
        return new Response('', $code);
    }

    public function fromRawData($data): Response
    {
        return new JsonResponse($data);
    }

    public function fromQueryResponse(QueryResponse $queryResponse): Response
    {
        return new JsonResponse([
            "data" => $queryResponse->data(),
            "meta" => $queryResponse->meta(),
        ]);
    }

    public function notFoundResponse(): Response
    {
        return new Response('', 404);
    }

    public function fromException(Throwable $exception): Response
    {
        return new Response('', $exception->getCode());
    }
}