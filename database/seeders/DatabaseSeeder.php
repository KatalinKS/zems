<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Project;
use App\Models\Task;
use App\Models\Tracking;
use App\Models\User;
use Illuminate\Database\Seeder;
use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(3)->create();

        print_r($users->pluck('email'));
        print_r(PHP_EOL.'пароль по умолчанию:  12345'.PHP_EOL);

        Project::factory(5)->create()->map(fn(Project $project) => $project->tasks()->saveMany(Task::factory(3)->make()));

        Tracking::factory(100)->create();

    }
}
