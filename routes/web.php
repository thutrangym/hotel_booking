<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\BookingController as UserBookingController;
use App\Http\Controllers\User\PaymentController;
use App\Models\User;

// ===== PUBLIC (GUEST) =====
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

        // AJAX route: dashboard stats (room status + revenue) for charts
        Route::get('/dashboard/stats', [DashboardController::class, 'stats'])
            ->name('dashboard.stats');

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
// ===== USER =====
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Booking
    Route::get('/booking/{room}', [UserBookingController::class, 'create'])
        ->name('booking.create');

    Route::post('/booking', [UserBookingController::class, 'store'])
        ->name('booking.store');

    Route::get('/my-bookings', [UserBookingController::class, 'history'])
        ->name('booking.history');
    Route::get('/my-bookings/{booking}', [UserBookingController::class, 'show'])
        ->name('booking.show');

    // Payment (MOCK)
    Route::get('/payment/{booking}', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::get('/payment-return', [PaymentController::class, 'return'])->name('payment.return');
    Route::post('/payment/retry/{booking}', [PaymentController::class, 'retry'])
        ->name('payment.retry');
});
