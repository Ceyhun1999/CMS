<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'admin/settings')->name('home');

Route::prefix('admin')->middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'authentication'])->name('authentication');
});

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('admin.settings.update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
