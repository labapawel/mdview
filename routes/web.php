<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/task/{category}/{task}', [TaskController::class, 'show'])->name('tasks.show');
Route::get('/task/{category}/{task}/download/{file}', [TaskController::class, 'download'])->name('tasks.download');

