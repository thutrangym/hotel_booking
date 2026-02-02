<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// ===== PUBLIC (KHÁCH) =====
Route::get('/', [PageController::class, 'home'])->name('home');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/live-with-us', [PageController::class, 'live'])->name('live');
Route::get('/rooms', [PageController::class, 'rooms'])->name('rooms.index');
Route::get('/rooms/{room}', [PageController::class, 'roomDetail'])->name('rooms.show');

Route::get('/facilities', [PageController::class, 'facilities'])->name('facilities');
Route::get('/offers', [PageController::class, 'offers'])->name('offers');


// ===== ADMIN =====

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('rooms', RoomController::class);
        Route::get('/admin/rooms/{room}', [AdminRoomController::class, 'show'])
            ->name('admin.rooms.show');
        Route::resource('bookings', BookingController::class);
        Route::get('/admin/bookings/{booking}/invoice', [BookingController::class, 'generateInvoice'])
            ->name('admin.bookings');
        Route::patch(
            'bookings/{booking}/status',
            [BookingController::class, 'update']
        )->name('bookings.update');

        Route::resource('users', AdminUserController::class);
        Route::get('/admin/users/{user}', [AdminUserController::class, 'show'])
            ->name('admin.users.show');
    });
