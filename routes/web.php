<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/profile', [PageController::class, 'profile'])->name('profile');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::resource('tasks', TaskController::class)
    ->except(['show'])
    ->middlewareFor(
        ['create', 'store', 'edit', 'update', 'destroy'],
        'auth'
    );

Route::get('/dashboard', function () {
    return redirect()->route('tasks.index');
})->middleware('auth')->name('dashboard');

require __DIR__.'/auth.php';