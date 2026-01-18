<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'admin/settings')->name('home');

Route::prefix('admin')->middleware('guest', 'prevent-back')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'authentication'])->name('authentication');
});

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::put('/settings', [SettingsController::class, 'update'])->middleware('throttle:2,1')->name('admin.settings.update');

    Route::get('/category', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.categories.store');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
