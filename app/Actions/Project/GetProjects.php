<?php

namespace App\Actions\Project;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class GetProjects
{
    public function get(): Collection
    {
        return Project::with(['tasks.tracking' => fn (HasMany $builder) => $builder->orderByDesc('started_at')])
            ->get();
    }
}
