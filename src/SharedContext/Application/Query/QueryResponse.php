<?php

declare(strict_types=1);

namespace App\SharedContext\Application\Query;

use Countable;

class QueryResponse
{
    private Meta $meta;

    public function __construct(
        private iterable|Countable $data,
        Meta $meta = null,
    ) {
        if (null === $meta) {
            $this->meta = new Meta(count($data));
        }
    }

    public function data(): iterable
    {
        return $this->data;
    }

    public function meta(): Meta
    {
        return $this->meta;
    }
}
