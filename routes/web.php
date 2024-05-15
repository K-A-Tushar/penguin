<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// tushar edit
Route::get('/todos', [TodoController::class, 'index'])->name('todo.index'); 
// Route::get('/todo', [TodoController::class, 'create']);
// Route::get('/todo', [TodoController::class, 'store']);
Route::middleware('auth')->group(function () {
    Route::get('/todo/add', [TodoController::class, 'create']);
    Route::post('/todo', [TodoController::class, 'store']);
    Route::get('/users', [UserController::class, 'index'])->name('users');
});
// tushar edit end

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';