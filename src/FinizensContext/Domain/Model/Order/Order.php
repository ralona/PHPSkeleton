<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\Model\Order;

use App\FinizensContext\Domain\Event\Order\OrderCreated;
use App\FinizensContext\Domain\Event\Order\OrderDeleted;
use App\FinizensContext\Domain\Event\Order\OrderUpdated;
use App\FinizensContext\Domain\ValueObject\Allocation\AllocationId;
use App\FinizensContext\Domain\ValueObject\Allocation\Shares;
use App\FinizensContext\Domain\ValueObject\Order\OrderId;
use App\FinizensContext\Domain\ValueObject\Order\OrderStatus;
use App\FinizensContext\Domain\ValueObject\Order\OrderType;
use App\FinizensContext\Domain\ValueObject\Portfolio\PortfolioId;
use App\SharedContext\Domain\Event\DomainEventPublisher;
use Carbon\CarbonImmutable;

class Order
{
    private string $id;
    private string $type;
    private string $status;

    private string $portfolioId;
    private string $allocationId;
    private int $shares;

    private CarbonImmutable $createdAt;
    private CarbonImmutable $updatedAt;
    private ?CarbonImmutable $deletedAt;

    public function __construct(
        OrderId $orderId,
        OrderType $orderType,
        PortfolioId $portfolioId,
        AllocationId $allocationId,
        Shares $shares,
    ) {
        $this->id = $orderId->value();

        $this->type = $orderType->value();
        $this->status = OrderStatus::pending()->value();

        $this->portfolioId = $portfolioId->value();
        $this->allocationId = $allocationId->value();
        $this->shares = $shares->value();

        $this->createdAt = CarbonImmutable::now('UTC');
        $this->updatedAt = CarbonImmutable::now('UTC');

        DomainEventPublisher::publish(new OrderCreated($this->id(), $this->type()));
    }

    public function markAsCompleted(): void
    {
        $this->status = OrderStatus::complete()->value();

        $this->updatedAt = CarbonImmutable::now('UTC');

        DomainEventPublisher::publish(new OrderUpdated($this->id(), $this->type()));
    }

    public function delete(): void
    {
        $this->updatedAt = $this->deletedAt = CarbonImmutable::now('UTC');

        DomainEventPublisher::publish(new OrderDeleted($this->id(), $this->type()));
    }

    public function id(): OrderId
    {
        return new OrderId($this->id);
    }

    public function type(): OrderType
    {
        return new OrderType($this->type);
    }

    public function status(): OrderStatus
    {
        return new OrderStatus($this->status);
    }

    public function portfolioId(): PortfolioId
    {
        return new PortfolioId($this->portfolioId);
    }

    public function allocationId(): AllocationId
    {
        return new AllocationId($this->allocationId);
    }

    public function shares(): Shares
    {
        return new Shares($this->shares);
    }

    public function createdAt(): CarbonImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): CarbonImmutable
    {
        return $this->updatedAt;
    }

    public function deletedAt(): ?CarbonImmutable
    {
        return $this->deletedAt;
    }
}