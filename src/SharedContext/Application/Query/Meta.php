<?php

declare(strict_types=1);

namespace App\SharedContext\Application\Query;

class Meta
{
    public function __construct(
        private int $total = 0,
        private int $itemsPerPage = 20,
        private int $page = 1,
    ) {

    }

    public function total(): int
    {
        return $this->total;
    }

    public function itemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    public function page(): int
    {
        return $this->page;
    }
}
