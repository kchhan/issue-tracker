<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('home');
    });

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/priority_chart', [HomeController::class, 'priorityChart']);
    Route::get('/type_chart', [HomeController::class, 'typeChart']);
    Route::get('/status_chart', [HomeController::class, 'statusChart']);
    Route::get('/priority_chart_manager', [HomeController::class, 'priorityChartManager']);
    Route::get('/status_chart_manager', [HomeController::class, 'statusChartManager']);

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::get('/projects/create', [ProjectController::class, 'create']);
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit']);
    Route::get('/projects/{project}', [ProjectController::class, 'show']);
    Route::patch('/projects/{project}', [ProjectController::class, 'update']);
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);

    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
    Route::get('/tickets/create', [TicketController::class, 'create']);
    Route::post('/tickets', [TicketController::class, 'store']);
    Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit']);
    Route::get('/tickets/{ticket}', [TicketController::class, 'show']);
    Route::patch('/tickets/{ticket}', [TicketController::class, 'update']);
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy']);

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::patch('/notifications/{notification}', [NotificationController::class, 'update']);

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{user}/edit', [UserController::class, 'edit']);
    Route::patch('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

    Route::get('/profiles/{user:username}', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profiles/{user:username}/edit', [ProfileController::class, 'edit']);
    Route::patch('/profiles/{user:username}', [ProfileController::class, 'update']);
});

Auth::routes();
