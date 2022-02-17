<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Listener;

use RuntimeException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Throwable;

class ParserJsonContentListener implements EventSubscriberInterface
{
    public function onRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();

        $jsonContent = $request->getContent() ?: "{}";

        try {
            $payload = json_decode($jsonContent, true, 512, JSON_THROW_ON_ERROR);
            $request->request->add($payload);
        } catch (Throwable $e) {
            throw new RuntimeException("", 0, $e);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onRequest',
        ];
    }
}