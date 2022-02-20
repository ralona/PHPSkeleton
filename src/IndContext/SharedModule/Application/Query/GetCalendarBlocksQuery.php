<?php

declare(strict_types=1);

namespace App\IndContext\SharedModule\Application\Query;

use App\SharedContext\Application\Query\Query;
use Carbon\CarbonImmutable;

class GetCalendarBlocksQuery extends Query
{
    public function __construct(
        private CarbonImmutable $startDate,
        private CarbonImmutable $endDate,
    ) {
    }

    public function startDate(): CarbonImmutable
    {
        return $this->startDate;
    }

    public function endDate(): CarbonImmutable
    {
        return $this->endDate;
    }
}
