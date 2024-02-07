<?php

namespace App\Actions\Tracking;

use App\Models\User;

class StartTracking
{
    public function start(User $user, array $data): void
    {
        if (!$user->hasActiveTracking()) {

            $user->newTracking([
                    'started_at' => now(),
                    ...$data
                ]
            );

        } else {
            throw new \Exception('Трекинг времени уже запущен');
        }
    }
}
