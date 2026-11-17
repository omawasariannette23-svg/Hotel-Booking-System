
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

// ========================================
// HOMEPAGE
// ========================================

Route::get('/', function () {
    return view('home');
})->name('home');

// ========================================
// AUTHENTICATION
// ========================================

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Registration
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.submit');

// ========================================
// DASHBOARDS
// ========================================

// Admin Dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

// Staff Dashboard
Route::get('/staff/dashboard', function () {
    return view('staff.dashboard');
})->middleware(['auth', 'role:staff'])
    ->name('staff.dashboard');

// Customer Dashboard
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'role:user'])
    ->name('user.dashboard');

// ========================================
// AVAILABLE ROOMS
// ========================================

Route::get('/rooms', [RoomController::class, 'available'])
    ->middleware(['auth', 'role:user,staff,admin'])
    ->name('rooms.available');

Route::get('/rooms/{room}', [RoomController::class, 'show'])
    ->middleware(['auth', 'role:user,staff,admin'])
    ->name('rooms.show');

// ========================================
// ADMIN ROOM MANAGEMENT
// ========================================

Route::get('/admin/rooms', [RoomController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.rooms.index');

Route::get('/admin/rooms/create', [RoomController::class, 'create'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.rooms.create');

Route::post('/admin/rooms', [RoomController::class, 'store'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.rooms.store');

Route::get('/admin/rooms/{id}/edit', [RoomController::class, 'edit'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.rooms.edit');

Route::put('/admin/rooms/{id}', [RoomController::class, 'update'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.rooms.update');

Route::delete('/admin/rooms/{id}', [RoomController::class, 'destroy'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.rooms.destroy');

// ========================================
// CUSTOMER RESERVATIONS
// ========================================

Route::get('/reservations/create', [ReservationController::class, 'create'])
    ->middleware(['auth', 'role:user'])
    ->name('reservations.create');

Route::post('/reservations', [ReservationController::class, 'store'])
    ->middleware(['auth', 'role:user'])
    ->name('reservations.store');

Route::get('/my-reservations', [ReservationController::class, 'index'])
    ->middleware(['auth', 'role:user'])
    ->name('reservations.index');

Route::patch('/my-reservations/{id}/cancel', [ReservationController::class, 'cancel'])
    ->middleware(['auth', 'role:user'])
    ->name('reservations.cancel');

// ========================================
// STAFF AND ADMIN RESERVATION MANAGEMENT
// ========================================

// Active Reservations
Route::get('/staff/reservations', [ReservationController::class, 'staffIndex'])
    ->middleware(['auth', 'role:staff,admin'])
    ->name('staff.reservations.index');

// Reservation History
Route::get('/staff/reservations/history', [ReservationController::class, 'staffHistory'])
    ->middleware(['auth', 'role:staff,admin'])
    ->name('staff.reservations.history');

// Approve Reservation
Route::patch('/staff/reservations/{id}/approve', [ReservationController::class, 'confirm'])
    ->middleware(['auth', 'role:staff,admin'])
    ->name('staff.reservations.confirm');

// Deny Reservation
Route::patch('/staff/reservations/{id}/deny', [ReservationController::class, 'deny'])
    ->middleware(['auth', 'role:staff,admin'])
    ->name('staff.reservations.deny');

// Check In Reservation
Route::patch('/staff/reservations/{id}/check-in', [ReservationController::class, 'checkIn'])
    ->middleware(['auth', 'role:staff,admin'])
    ->name('staff.reservations.checkin');

// Check Out Reservation
Route::patch('/staff/reservations/{id}/check-out', [ReservationController::class, 'checkOut'])
    ->middleware(['auth', 'role:staff,admin'])
    ->name('staff.reservations.checkout');
