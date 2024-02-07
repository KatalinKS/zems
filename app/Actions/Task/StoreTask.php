<?php

namespace App\Actions\Task;

use App\Models\Task;

class StoreTask
{
    public function store(array $data): void
    {
        Task::create($data);
    }

}
