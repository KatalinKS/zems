<?php

namespace App\DTO;

class OrderBy
{
    public function __construct(
        public readonly string $column = 'id',
        public readonly string $direction = 'asc',
    )
    {
    }
}
