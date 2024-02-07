<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tracking>
 */
class TrackingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'task_id' => Task::inRandomOrder()->first(),
            'user_id' => User::inRandomOrder()->first(),
            'started_at' => now(),
            'stopped_at' => now()->addMinutes(rand(10,120)),
        ];
    }
}
