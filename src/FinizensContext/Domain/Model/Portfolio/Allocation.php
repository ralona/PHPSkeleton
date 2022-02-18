<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\Model\Portfolio;

use App\FinizensContext\Domain\Event\Allocation\AllocationCreated;
use App\FinizensContext\Domain\Event\Allocation\AllocationUpdated;
use App\FinizensContext\Domain\ValueObject\Allocation\AllocationId;
use App\FinizensContext\Domain\ValueObject\Allocation\Shares;
use App\SharedContext\Domain\Event\DomainEventPublisher;
use Carbon\CarbonImmutable;

class Allocation
{
    private string $id;
    private Portfolio $portfolio;
    private int $shares;

    private CarbonImmutable $createdAt;
    private CarbonImmutable $updatedAt;

    public function __construct(
        AllocationId $id,
        Portfolio $portfolio,
        Shares $shares,
    ) {
        $this->id = $id->value();
        $this->portfolio = $portfolio;

        $this->doUpdateData($shares);

        $this->createdAt = CarbonImmutable::now('UTC');
        $this->updatedAt = CarbonImmutable::now('UTC');

        DomainEventPublisher::publish(new AllocationCreated($this->id()));
    }

    private function doUpdateData(Shares $shares): void
    {
        $this->shares = $shares->value();
    }

    public function update(Shares $shares): void
    {
        $this->doUpdateData($shares);

        $this->updatedAt = CarbonImmutable::now('UTC');

        DomainEventPublisher::publish(new AllocationUpdated($this->id()));

    }

    public function id(): AllocationId
    {
        return new AllocationId($this->id);
    }

    public function portfolio(): Portfolio
    {
        return $this->portfolio;
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
}