<?php

namespace App\Actions\Tracking;

use App\DTO\OrderBy;
use App\Models\Project;
use App\Models\Tracking;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GetTrackingForUserByProject
{
    public function get(User $user, Project $project): Collection
    {

        return Tracking::whereHas('task',
            fn (Builder $builder) => $builder->where('project_id', $project->getId())
        )->where('user_id', $user->getId())
            ->with('task')
            ->get();
    }
}
