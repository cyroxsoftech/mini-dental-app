<?php

declare(strict_types=1);

use App\Http\Controllers\Account\DashboardController;
use App\Http\Controllers\Account\DentistController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\Password\ConfirmablePasswordController;
use App\Http\Controllers\Auth\Password\ConfirmedPasswordStatusController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use App\Http\Controllers\Auth\Password\NewPasswordController;
use App\Http\Controllers\Auth\Password\PasswordController;
use App\Http\Controllers\Auth\Password\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;
use Laravel\Fortify\RoutePath;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/
$allowedGuards = implode(',', array_keys(config('auth.guards')));
$enableViews = config('fortify.views', true);

// Authentication...
if ($enableViews) {
    Route::get(RoutePath::for('login', '/login'), [AuthenticatedSessionController::class, 'create'])
        ->middleware(['guest:' . $allowedGuards])
        ->name('login');
}

$limiter = config('fortify.limiters.login');
$twoFactorLimiter = config('fortify.limiters.two-factor');
$verificationLimiter = config('fortify.limiters.verification', '6,1');

Route::post(RoutePath::for('login', '/login'), [AuthenticatedSessionController::class, 'store'])
    ->middleware(array_filter([
        'guest:' . $allowedGuards,
        $limiter ? 'throttle:' . $limiter : null,
    ]))->name('login.store');

Route::post(RoutePath::for('logout', '/logout'), [AuthenticatedSessionController::class, 'destroy'])
    ->middleware([config('fortify.auth_middleware', 'auth') . ':' . $allowedGuards])
    ->name('logout');

// Password Reset...
if (Features::enabled(Features::resetPasswords())) {
    if ($enableViews) {
        Route::get(RoutePath::for('password.request', '/forgot-password'), [PasswordResetLinkController::class, 'create'])
            ->middleware(['guest:' . $allowedGuards])
            ->name('password.request');

        Route::get(RoutePath::for('password.reset', '/reset-password/{token}'), [NewPasswordController::class, 'create'])
            ->middleware(['guest:' . $allowedGuards])
            ->name('password.reset');
    }

    Route::post(RoutePath::for('password.email', '/forgot-password'), [PasswordResetLinkController::class, 'store'])
        ->middleware(['guest:' . $allowedGuards])
        ->name('password.email');

    Route::post(RoutePath::for('password.update', '/reset-password'), [NewPasswordController::class, 'store'])
        ->middleware(['guest:' . $allowedGuards])
        ->name('password.update');
}

// Registration...
if (Features::enabled(Features::registration())) {
    if ($enableViews) {
        Route::get(RoutePath::for('register', '/register'), [RegisteredUserController::class, 'create'])
            ->middleware(['guest:' . $allowedGuards])
            ->name('register');
    }

    Route::post(RoutePath::for('register', '/register'), [RegisteredUserController::class, 'store'])
        ->middleware(['guest:' . $allowedGuards])
        ->name('register.store');
}

// Email Verification...
if (Features::enabled(Features::emailVerification())) {
    if ($enableViews) {
        Route::get(RoutePath::for('verification.notice', '/email/verify'), [EmailVerificationPromptController::class, '__invoke'])
            ->middleware([config('fortify.auth_middleware', 'auth') . ':' . $allowedGuards])
            ->name('verification.notice');
    }

    Route::get(RoutePath::for('verification.verify', '/email/verify/{id}/{hash}'), [VerifyEmailController::class, '__invoke'])
        ->middleware([config('fortify.auth_middleware', 'auth') . ':' . $allowedGuards, 'signed', 'throttle:' . $verificationLimiter])
        ->name('verification.verify');

    Route::post(RoutePath::for('verification.send', '/email/verification-notification'), [EmailVerificationNotificationController::class, 'store'])
        ->middleware([config('fortify.auth_middleware', 'auth') . ':' . $allowedGuards, 'throttle:' . $verificationLimiter])
        ->name('verification.send');
}

// Profile Information...
if (Features::enabled(Features::updateProfileInformation())) {
    Route::put(RoutePath::for('user-profile-information.update', '/user/profile-information'), [ProfileInformationController::class, 'update'])
        ->middleware([config('fortify.auth_middleware', 'auth') . ':' . $allowedGuards])
        ->name('user-profile-information.update');
}

// Passwords...
if (Features::enabled(Features::updatePasswords())) {
    Route::put(RoutePath::for('user-password.update', '/user/password'), [PasswordController::class, 'update'])
        ->middleware([config('fortify.auth_middleware', 'auth') . ':' . $allowedGuards])
        ->name('user-password.update');
}

// Password Confirmation...
if ($enableViews) {
    Route::get(RoutePath::for('password.confirm', '/user/confirm-password'), [ConfirmablePasswordController::class, 'show'])
        ->middleware([config('fortify.auth_middleware', 'auth') . ':' . $allowedGuards])
        ->name('password.confirm');
}

Route::get(RoutePath::for('password.confirmation', '/user/confirmed-password-status'), [ConfirmedPasswordStatusController::class, 'show'])
    ->middleware([config('fortify.auth_middleware', 'auth') . ':' . $allowedGuards])
    ->name('password.confirmation');

Route::post(RoutePath::for('password.confirm', '/user/confirm-password'), [ConfirmablePasswordController::class, 'store'])
    ->middleware([config('fortify.auth_middleware', 'auth') . ':' . $allowedGuards])
    ->name('password.confirm.store');


Route::get('dashboard', [DashboardController::class, 'index'])->name('home');
Route::get('diagnosis/treatment-plans', [DentistController::class, 'getTreatmentPlans'])->name('dentist.plans.index');
