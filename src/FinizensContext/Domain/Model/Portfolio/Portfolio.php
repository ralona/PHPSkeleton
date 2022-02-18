<?php

declare(strict_types=1);

namespace App\FinizensContext\Domain\Model\Portfolio;

use App\FinizensContext\Domain\Event\Allocation\AllocationDeleted;
use App\FinizensContext\Domain\Event\Portfolio\PortfolioCreated;
use App\FinizensContext\Domain\Event\Portfolio\PortfolioDeleted;
use App\FinizensContext\Domain\Event\Portfolio\PortfolioUpdated;
use App\FinizensContext\Domain\ValueObject\Allocation\AllocationId;
use App\FinizensContext\Domain\ValueObject\Portfolio\PortfolioId;
use App\SharedContext\Domain\Event\DomainEventPublisher;
use Carbon\CarbonImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Portfolio
{
    private string $id;
    private Collection $allocations;

    private CarbonImmutable $createdAt;
    private CarbonImmutable $updatedAt;
    private ?CarbonImmutable $deletedAt;

    public function __construct(
        PortfolioId $portfolioId,
        Allocation ...$allocations,
    ) {
        $this->id = $portfolioId->value();
        $this->allocations = new ArrayCollection($allocations);

        $this->createdAt = CarbonImmutable::now('UTC');
        $this->updatedAt = CarbonImmutable::now('UTC');

        DomainEventPublisher::publish(new PortfolioCreated($this->id()));
    }

    public function addAllocation(Allocation $allocation): self
    {
        $equalsAllocation = $this->filterAllocationsById($allocation->id());

        if (!empty($equalsAllocation)) {
            return $this;
        }

        $this->allocations->add($allocation);

        DomainEventPublisher::publish(new PortfolioUpdated($this->id()));

        return $this;
    }

    public function deleteAllocationById(AllocationId $allocationId): self
    {
        $equalsAllocation = $this->filterAllocationsById($allocationId);

        if (empty($equalsAllocation)) {
            return $this;
        }

        $this->allocations->remove(array_key_first($equalsAllocation));

        DomainEventPublisher::publish(new AllocationDeleted($allocationId));
        DomainEventPublisher::publish(new PortfolioUpdated($this->id()));

        return $this;
    }

    public function delete(): void
    {
        $this->deletedAt = CarbonImmutable::now('UTC');

        DomainEventPublisher::publish(new PortfolioDeleted($this->id()));
    }

    public function id(): PortfolioId
    {
        return new PortfolioId($this->id);
    }

    /** @return Allocation[] */
    public function allocations(): array
    {
        return $this->allocations->toArray();
    }

    public function allocation(AllocationId $allocationId): ?Allocation
    {
        foreach ($this->allocations() as $allocation) {
            if ($allocation->id()->equals($allocationId)) {
                return $allocation;
            }
        }

        return null;
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

    private function filterAllocationsById(AllocationId $allocationId): array
    {
        return array_filter($this->allocations(), static function (Allocation $allocation) use ($allocationId) {
            return $allocation->id()->equals($allocationId);
        });
    }
}