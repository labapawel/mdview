<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'categories'])->name('categories.index');
Route::get('/category/{category}', [TaskController::class, 'index'])->name('category.show'); // Alias for task index filtered by category
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index'); // Fallback/Search route
Route::get('/task/{category}/{task}', [TaskController::class, 'show'])->name('tasks.show');
Route::get('/task/{category}/{task}/download/{file}', [TaskController::class, 'download'])->name('tasks.download');

