<?php

namespace App\Actions\Project;

use App\Models\Project;

class StoreProject
{
    public function store(array $data): void
    {
        Project::create($data);
    }

}
