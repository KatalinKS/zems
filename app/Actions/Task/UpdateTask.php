<?php

namespace App\Actions\Task;

use App\Models\Task;

class UpdateTask
{
    public function update(Task $task, array $data): void
    {
        $task->update($data);
    }

}
