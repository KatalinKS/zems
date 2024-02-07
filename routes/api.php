<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //Project
    Route::group(['prefix' => 'project'], function() {
        Route::get('', [ProjectController::class, 'index'])->name('api.project.index');
        Route::post('', [ProjectController::class, 'store'])->name('api.project.store');

        Route::group(['prefix' => '{project}'], function() {
            Route::put('', [ProjectController::class, 'update'])->name('api.project.update');
            Route::delete('', [ProjectController::class, 'destroy'])->name('api.project.destroy');
        });
    });

    //Tracking
    Route::get('/tracking', [\App\Http\Controllers\Api\TrackingController::class, 'index'])->name('api.tracking');
    Route::post('start-tracking', [\App\Http\Controllers\Api\TrackingController::class, 'startTracking'])->name('api.tracking.start');
    Route::post('stop-tracking', [\App\Http\Controllers\Api\TrackingController::class, 'stopTracking'])->name('api.tracking.stop');

    //Task
    Route::put('', [TaskController::class, 'store'])->name('api.task.store');
    Route::group(['prefix' => 'task/{task}'], function() {
        Route::put('', [TaskController::class, 'update'])->name('api.task.update');
        Route::delete('', [TaskController::class, 'destroy'])->name('api.task.destroy');
    });
});
