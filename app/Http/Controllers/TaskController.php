<?php

namespace App\Http\Controllers;

use App\Actions\Project\GetProjects;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function create(CreateTaskRequest $request, GetProjects $getProjects)
    {
        return Inertia::render('Task/CreateTask', [
            'projects' => $getProjects->get(),
            'selectedProjectId' => (int) $request->get('project'),
        ]);
    }
    public function edit(Task $task, GetProjects $getProjects)
    {
        return Inertia::render('Task/TaskEdit', [
            'task' => $task,
            'projects' => $getProjects->get(),
        ]);
    }
}
