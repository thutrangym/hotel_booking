<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;

// ===== PUBLIC (KHÁCH) =====
Route::get('/', [PageController::class, 'home'])->name('home');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/live-with-us', [PageController::class, 'live'])->name('live');
Route::get('/rooms', [PageController::class, 'rooms'])->name('rooms');
Route::get('/facilities', [PageController::class, 'facilities'])->name('facilities');
Route::get('/offers', [PageController::class, 'offers'])->name('offers');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// ===== ADMIN =====

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('rooms', RoomController::class);
        Route::get('/admin/rooms/{room}', [AdminRoomController::class, 'show'])
            ->name('admin.rooms.show');

        Route::resource('bookings', BookingController::class)->only(['index', 'show', 'update']);
        Route::resource('users', UserController::class)->only(['index', 'edit', 'update']);
    });
