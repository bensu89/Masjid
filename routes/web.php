<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Public (Warga)
Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin only (Protected by auth)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [TransactionController::class, 'adminIndex'])->name('transactions.admin');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{id}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::put('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
});
