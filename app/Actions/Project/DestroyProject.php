<?php

namespace App\Actions\Project;

use App\Models\Project;

class DestroyProject
{
    public function destroy(Project $project): void
    {
        $project->delete();
    }

}
