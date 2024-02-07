<?php

namespace App\Actions\Task;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class AllExecutedProjectTask
{
    public function get(Project $project): Collection
    {
        return Task::where('project_id', $project->getId())
            ->whereHas('tracking')
            ->get();
    }
}
