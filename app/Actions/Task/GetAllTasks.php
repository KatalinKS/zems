<?php

namespace App\Actions\Task;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class GetAllTasks
{
    public function get(): Collection
    {
        return Task::all();
    }
}
