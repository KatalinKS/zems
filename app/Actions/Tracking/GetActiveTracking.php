<?php

namespace App\Actions\Tracking;

use App\Models\Project;
use App\Models\Tracking;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class GetActiveTracking
{
    public function get(User $user): ?Tracking
    {
        return $user->getActiveTracking();
    }
}
