<?php

declare(strict_types=1);

namespace App\SharedContext\Infrastructure\Bus;

use App\SharedContext\Application\Query\Query;
use App\SharedContext\Application\Query\QueryResponse;
use League\Tactician\CommandBus as TacticianBus;

class TacticianQueryBus implements QueryBus
{
    public function __construct(
        private TacticianBus $tacticianBus,
    ) {
    }

    public function handle(Query $query): QueryResponse
    {
        return $this->tacticianBus->handle($query);
    }
}
