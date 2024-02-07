<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    //Tracker
    Route::get('/', [\App\Http\Controllers\TimeTrackerController::class, 'index'])->name('time_tracker');

    //Project
    Route::group(['prefix' => 'project'], function() {
        Route::get('', [ProjectController::class, 'index'])->name('projects');
        Route::get('add', [ProjectController::class, 'create'])->name('project.create');

        Route::group(['prefix' => '{project}'], function() {
            Route::get('statistic', [ProjectController::class, 'statistic'])->name('project.statistic');
            Route::get('edit', [ProjectController::class, 'edit'])->name('project.edit');
        });
    });

    //Task
    Route::group(['prefix' => 'task'], function() {
        Route::get('/', [TaskController::class, 'create'])->name('task.add');
        Route::group(['prefix' => '{task}'], function() {
            Route::get('edit', [TaskController::class, 'edit'])->name('task.edit');
        });
    });
});
