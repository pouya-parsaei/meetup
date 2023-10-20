<?php

use App\Http\Controllers\IdentityAndAccess\Controllers\UserRegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->middleware('guest')
    ->name('auth.')
    ->group(function () {
        Route::post('/register', UserRegisterController::class)->name('register');
    });
