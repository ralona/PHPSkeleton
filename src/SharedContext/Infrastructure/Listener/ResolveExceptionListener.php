<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Listener;

use App\SharedContext\Domain\Exception\InvalidLogicException;
use App\SharedContext\Infrastructure\Exception\ValidationException;
use App\SharedContext\Infrastructure\Response\ResponseFactory;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class ResolveExceptionListener implements EventSubscriberInterface
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function onEvent(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof MethodNotAllowedHttpException) {
            $event->setResponse($this->responseFactory->emptyResponse(405));
            return;
        }

        if ($exception instanceof ValidationException) {
            $event->setResponse($this->responseFactory->fromException($exception));
            return;
        }

        if ($exception instanceof InvalidLogicException) {
            $event->setResponse($this->responseFactory->emptyResponse(500));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onEvent',
        ];
    }
}