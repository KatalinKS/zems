<?php

namespace App\Http\Controllers\Api;

use App\Actions\Tracking\GetTrackingForUser;
use App\Actions\Tracking\StartTracking;
use App\Actions\Tracking\StopTracking;
use App\DTO\OrderBy;
use App\Http\Controllers\Controller;
use App\Http\Requests\StartTrackingRequest;
use App\Http\Requests\StopTrackingRequest;
use App\Models\User;
use Inertia\Inertia;

class TrackingController extends Controller
{
    public function startTracking(StartTrackingRequest $request, User $user, StartTracking $startTracking)
    {
        $startTracking->start($user, $request->all(['task_id', 'name']));

        return [
            'message' => 'success'
        ];
    }

    public function stopTracking(StopTrackingRequest $request, User $user, StopTracking $stopTracking)
    {
        $stopTracking->stop($user, $request->all(['task_id', 'name']));

        return [
            'message' => 'success'
        ];
    }

    public function index(GetTrackingForUser $trackingForUser, User $user)
    {
        return [
            'data' => $trackingForUser->get($user, new OrderBy('started_at', 'desc')),
        ];
    }
}
