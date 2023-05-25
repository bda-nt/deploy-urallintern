<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;

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

Route::controller(StatusController::class)->group(function () {
    Route::prefix('/statuses')->group(function () {
        Route::get('/', 'index');
    });
});

Route::controller(ProjectController::class)->group(function () {
    Route::prefix('/projects')->group(function () {
        Route::get('/', 'index');
    });
});

Route::controller(TeamController::class)->group(function () {
    Route::prefix('/teams')->group(function () {
        Route::get('/', 'index');
    });
});

Route::controller(UserController::class)->group(function () {
    Route::prefix('/users')->group(function () {
        Route::get('/', 'index');
    });
});

Route::controller(TaskController::class)->group(function () {
    Route::prefix('/tasks')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{taskId}', 'show')->whereNumber('taskId');
        Route::put('/{taskId}', 'update')->whereNumber('taskId');
        Route::delete('/{taskId}', 'destroy')->whereNumber('taskId');
    });
});

Route::controller(CommentController::class)->group(function () {
    Route::prefix('/comments')->group(function () {
        Route::post('/', 'store');
        Route::delete('/', 'destroy');
    });
});
