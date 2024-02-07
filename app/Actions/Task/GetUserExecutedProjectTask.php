<?php

namespace App\Actions\Task;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class GetUserExecutedProjectTask
{
    public function get(Project $project, User $user): Collection
    {
        return Task::where('project_id', $project->getId())
            ->with('tracking')
            ->whereHas('tracking', fn(Builder $builder) => $builder->where('user_id', $user->getId()))
            ->get();
    }
}
