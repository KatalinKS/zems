<?php

namespace App\Actions\Tracking;

use App\Models\User;

class StopTracking
{
    public function stop(User $user, array $data): void
    {
        if ($user->hasActiveTracking()) {

            $user->updateActiveTracking([
                    'stopped_at' => now(),
                    ...$data
                ]
            );

        } else {
            throw new \Exception('Трекинг времени уже запущен');
        }
    }
}
