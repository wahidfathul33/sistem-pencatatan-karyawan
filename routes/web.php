<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\NilaiSkpsController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {

    Route::controller(AuthenticationController::class)->group(function () {
        Route::get('login', 'login')->name('auth.login');
//        Route::get('register', 'register')->name('auth.register');
    });

    Route::controller(PasswordResetController::class)->group(base_path('routes/password-reset-routes.php'));
});

Route::get('logout', [AuthenticationController::class, 'logout'])->middleware('auth')->name('auth.logout');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', fn () => to_route('dashboard.index'))->name('home');
    Route::get('dashboard', fn () => view('example'))->name('dashboard.index');

    Route::controller(EmailVerificationController::class)->group(base_path('routes/email-verification-routes.php'));
    Route::resource('user', UserController::class)->only('index');
    Route::resource('role', RoleController::class)->only('index');
    Route::resource('permission', PermissionController::class)->only('index');

    Route::get('desa', App\Http\Livewire\Desa\Index::class)->name('desa.index');
    Route::get('kendaraan', App\Http\Livewire\Kendaraan\Index::class)->name('kendaraan.index');
});
