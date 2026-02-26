<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect('/colocations') : redirect('/login');
});

Route::get('/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::resource('colocations', ColocationController::class);
    Route::get('/colocations/{colocation}/expenses/create', [App\Http\Controllers\ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('/expenses', [App\Http\Controllers\ExpenseController::class, 'store'])->name('expenses.store');

    Route::post('/categories', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
});
