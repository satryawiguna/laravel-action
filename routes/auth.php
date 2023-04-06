<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\Login\AttemptLogin;
use App\Http\Controllers\Auth\Login\AttemptLogout;
use App\Http\Controllers\Auth\Login\ViewLogin;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\Register\StoreRegister;
use App\Http\Controllers\Auth\Register\ViewRegister;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
//    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::get('register', ViewRegister::class)->name('register');

//    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::post('register', StoreRegister::class);

//    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::get('login', ViewLogin::class)->name('login');

//    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::post('login', AttemptLogin::class);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

//    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::post('logout', AttemptLogout::class)->name('logout');
});
