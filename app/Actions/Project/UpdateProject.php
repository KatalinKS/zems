<?php

namespace App\Actions\Project;

use App\Models\Project;

class UpdateProject
{
    public function update(Project $project, array $data): void
    {
        $project->update($data);
    }

}
