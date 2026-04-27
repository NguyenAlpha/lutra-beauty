<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\BookingController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/booking', [BookingController::class, 'store']);

// Admin auth
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(AdminAuth::class)->group(function () {
        Route::get('/', [BookingAdminController::class, 'index'])->name('bookings.index');
        Route::get('bookings/{booking}', [BookingAdminController::class, 'show'])->name('bookings.show');
        Route::patch('bookings/{booking}/status', [BookingAdminController::class, 'updateStatus'])->name('bookings.status');
        Route::delete('bookings/{booking}', [BookingAdminController::class, 'destroy'])->name('bookings.destroy');
    });
});
