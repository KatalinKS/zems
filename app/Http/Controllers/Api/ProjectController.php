<?php

namespace App\Http\Controllers\Api;

use App\Actions\Project\DestroyProject;
use App\Actions\Project\GetProjects;
use App\Actions\Project\StoreProject;
use App\Actions\Project\UpdateProject;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectsRequest;
use App\Http\Requests\UpdateProjectsRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(GetProjects $getProjects)
    {
        return [
          'data' => $getProjects->get(),
        ];
    }
    public function store(StoreProjectsRequest $request, StoreProject $storeProject)
    {
        $storeProject->store($request->all(['name', 'description']));

        return [
            'success',
        ];
    }
    public function update(UpdateProjectsRequest $request, Project $project, UpdateProject $updateProject)
    {
        $updateProject->update($project, $request->all(['name', 'description']));

        return [
            'success',
        ];
    }
    public function destroy(Project $project, DestroyProject $destroyProject)
    {
        $destroyProject->destroy($project);

        return [
            'success',
        ];
    }
}
