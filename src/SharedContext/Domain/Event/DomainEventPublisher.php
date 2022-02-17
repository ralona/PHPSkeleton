<?php

declare(strict_types=1);

namespace App\SharedContext\Domain\Event;

class DomainEventPublisher
{
    /** @var DomainEvent[] */
    private array $events;

    private static ?self $instance = null;

    public function __construct()
    {
        $this->events = [];
    }

    public static function instance(): self
    {
        if (null === static::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    public static function publish(DomainEvent $aDomainEvent): void
    {
        self::instance()->instancePublish($aDomainEvent);
    }

    public function instancePublish(DomainEvent $aDomainEvent): void
    {
        $this->events[] = $aDomainEvent;
    }

    public function allEvents(): array
    {
        return $this->events;
    }

    public function event(string $eventClass): ?DomainEvent
    {
        foreach ($this->events as $event) {
            if ($event instanceof $eventClass) {
                return $event;
            }
        }

        return null;
    }
}