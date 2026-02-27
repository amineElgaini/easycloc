<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect('/colocations') : redirect('/login');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users/{user}/toggle-ban', [AdminController::class, 'toggleBan'])->name('admin.users.toggle-ban');
    Route::post('/colocations/{colocation}/transfer-ownership/{user}', [ColocationController::class, 'transferOwnership'])->name('colocations.transfer-ownership');
});

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

    Route::post('/colocation/{id}/invite', [ColocationController::class, 'inviteMember'])
        ->name('colocation.invite.send');

    Route::get('/colocations/{colocation}/debts', [ColocationController::class, 'debts'])->name('colocations.debts');
    Route::post('/shares/{share}/settle', [ColocationController::class, 'settleShare'])->name('shares.settle');

    Route::get('/invitations/accept/{token}', [App\Http\Controllers\InvitationController::class, 'acceptView'])->name('invitations.accept.view');
    Route::post('/invitations/accept/{token}/process', [App\Http\Controllers\InvitationController::class, 'accept'])->name('invitations.accept.process');
    Route::post('/invitations/refuse/{token}', [App\Http\Controllers\InvitationController::class, 'refuse'])->name('invitations.refuse');

    Route::post('/colocations/{colocation}/leave', [ColocationController::class, 'leave'])->name('colocations.leave');
    Route::post('/colocations/{colocation}/kick/{user}', [ColocationController::class, 'kick'])->name('colocations.kick');
    Route::post('/colocations/{colocation}/cancel', [ColocationController::class, 'cancel'])->name('colocations.cancel');
});
