<?php

namespace App\Http\Controllers;

use App\Actions\Project\GetProjects;
use App\Actions\Task\GetAllTasks;
use App\Actions\Tracking\GetActiveTracking;
use App\Actions\Tracking\GetTrackingForUser;
use App\DTO\OrderBy;
use App\Models\User;
use Inertia\Inertia;

class TimeTrackerController extends Controller
{
    public function index(
        GetAllTasks        $allTasks,
        GetTrackingForUser $trackingForUser,
        GetActiveTracking  $activeTracking,
        User               $user
    )
    {
        return Inertia::render('Tracking/TimeTracker', [
            'tasks' => $allTasks->get(),
            'tracking' => $trackingForUser->get($user, new OrderBy('started_at', 'desc')),
            'activeTracking' => $activeTracking->get($user),
        ]);
    }
}
