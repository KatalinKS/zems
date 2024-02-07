<?php

namespace App\Actions\Tracking;

use App\DTO\OrderBy;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GetTrackingForUser
{
    public function get(User $user, OrderBy $orderBy): Collection
    {

        return $user->getStoppedTracking($orderBy)->load('task');
    }
}
