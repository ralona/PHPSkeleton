<?php

declare(strict_types=1);

namespace App\SharedContext\Application\Bus;

use App\SharedContext\Application\Query\Query;
use App\SharedContext\Application\Query\QueryResponse;

interface QueryBus
{
    public function handle(Query $query): QueryResponse;
}
