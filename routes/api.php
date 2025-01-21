<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WalletTypeController;
use Illuminate\Support\Facades\Route;




Route::prefix('v1')->group(function () {

    Route::name('auth.')->group(function () {
        Route::post('/register', [RegisterController::class, 'register'])->name('register');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('users', UserController::class)->except('store');
        Route::apiResource('wallets', WalletController::class)->only(['index', 'show']);
        Route::post('/wallets/transfer', [TransactionController::class, 'transfer'])->name('wallet.transfer');
        Route::apiResource('wallet_type', WalletTypeController::class)->only(['store', 'destroy']);
    });
});
