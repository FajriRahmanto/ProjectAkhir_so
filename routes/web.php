<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Main route
Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    return redirect()->route('dashboard');
});

// Authentication Routes
Auth::routes(['reset' => false]);

// Route untuk menampilkan dashboard dengan data tasks
Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index')->middleware('auth');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store')->middleware('auth');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit')->middleware('auth');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update')->middleware('auth');
Route::patch('/tasks/{task}/done', [TaskController::class, 'markDone'])->name('tasks.done')->middleware('auth');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy')->middleware('auth');
Route::get('/tasks/history', [TaskController::class, 'history'])->name('tasks.history')->middleware('auth');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');
