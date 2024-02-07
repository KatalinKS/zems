<?php

namespace App\Actions\Task;

use App\Models\Task;

class DestroyTask
{
    public function destroy(Task $task): void
    {
        $task->delete();
    }

}
