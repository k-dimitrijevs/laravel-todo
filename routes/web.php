<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('tasks/deleted', [TasksController::class, 'deleted'])
    ->middleware(['auth'])
    ->name('tasks.deleted');

Route::resource('tasks', TasksController::class)->middleware(['auth']);

Route::delete('/tasks/{id}/forceDelete', [TasksController::class, 'forceDelete'])
    ->middleware(['auth'])
    ->name('tasks.forceDelete');

Route::post('tasks/{id}/restore', [TasksController::class, 'restore'])
    ->middleware(['auth'])
    ->name('tasks.restore');

Route::patch('tasks/{task}/completed', [TasksController::class, 'complete'])
    ->middleware(['auth'])
    ->name('tasks.complete');

require __DIR__.'/auth.php';
