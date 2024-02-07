<?php

namespace App\Http\Controllers;

use App\Actions\Common\CalculateSpentTime;
use App\Actions\Project\GetProjects;
use App\Actions\Task\AllExecutedProjectTask;
use App\Actions\Task\GetUserExecutedProjectTask;
use App\Actions\Tracking\GetActiveTracking;
use App\Actions\Tracking\GetTrackingForUserByProject;
use App\Models\Project;
use App\Models\User;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user, GetProjects $getProjects, GetActiveTracking  $activeTracking,)
    {
        return Inertia::render('Project/Index', [
            'projects' => $getProjects->get(),
            'hasActiveTracking' => (bool) $activeTracking->get($user),
        ]);
    }

    public function create()
    {
        return Inertia::render('Project/CreateProject');
    }

    public function edit(Project $project)
    {
        return Inertia::render('Project/EditProject', [
            'project' => $project,
        ]);
    }

    public function statistic(
        Project $project,
        User $user,
        GetUserExecutedProjectTask $getUserExecutedProjectTask,
        AllExecutedProjectTask $allExecutedProjectTask,
        CalculateSpentTime $calculateSpentTime,
        GetTrackingForUserByProject $getTrackingForUserByProject,

    )
    {
        $myTasks = $getUserExecutedProjectTask->get($project, $user);
        $allTasks = $allExecutedProjectTask->get($project);

        return Inertia::render('Project/ProjectStatistic', [
            'project' => $project,
            'myTasks' => $myTasks,
            'allTasks' => $allTasks,
            'mySpentTime' => $calculateSpentTime->calculate($myTasks, 'my_time_spent_sec'),
            'totalSpentTime' => $calculateSpentTime->calculate($allTasks, 'total_time_spent_sec'),
            'tracking' => $getTrackingForUserByProject->get($user, $project),
        ]);
    }
}
