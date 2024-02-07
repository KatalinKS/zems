<?php

namespace App\Http\Controllers\Api;

use App\Actions\Project\GetProjects;
use App\Actions\Task\DestroyTask;
use App\Actions\Task\StoreTask;
use App\Actions\Task\UpdateTask;
use App\Http\Controllers\Controller;
use App\Http\Requests\DestorTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function update(UpdateTaskRequest $request, Task $task, UpdateTask $updateTask)
    {
        $updateTask->update($task, $request->all('name', 'project_id', 'description'));

        return [
            'message' => 'success',
        ];
    }

    public function store(StoreTaskRequest $request, StoreTask $storeTask)
    {
        $storeTask->store($request->all('name', 'project_id', 'description'));

        return [
            'message' => 'success',
        ];
    }

    public function destroy(DestorTaskRequest $request, Task $task, DestroyTask $destroyTask)
    {
        $destroyTask->destroy($task);

        return [
            'message' => 'success',
        ];
    }


}
