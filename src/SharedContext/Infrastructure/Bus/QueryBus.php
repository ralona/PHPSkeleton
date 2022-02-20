<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Bus;

use App\SharedContext\Application\Query\Query;
use App\SharedContext\Application\Query\QueryResponse;

interface QueryBus
{
    public function handle(Query $query): QueryResponse;
}
