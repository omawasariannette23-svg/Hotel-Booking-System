<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;

// Homepage
Route::get('/', function () {
    return view('welcome');
});

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

// Admin Dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin']);

// Staff Dashboard
Route::get('/staff/dashboard', function () {
    return view('staff.dashboard');
})->middleware(['auth', 'role:staff']);

// Customer Dashboard
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'role:user'])
  ->name('user.dashboard');

Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('guest')
    ->name('register.submit');

    // Customer Available Rooms
Route::get('/rooms', [RoomController::class, 'available'])
    ->middleware(['auth', 'role:user,staff,admin'])
    ->name('rooms.available');

// Admin Rooms

Route::get('/admin/rooms', [RoomController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.rooms.index');   

    Route::post('/admin/rooms', [RoomController::class, 'store'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.rooms.store');

    Route::get('/admin/rooms/create', [RoomController::class, 'create'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.rooms.create');

    Route::get('/admin/rooms/{id}/edit', [RoomController::class, 'edit'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.rooms.edit');

//Editting Rooms
    Route::get('/admin/rooms/{id}/edit', [RoomController::class, 'edit'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.rooms.edit');

Route::put('/admin/rooms/{id}', [RoomController::class, 'update'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.rooms.update');

    // Delete Room
Route::delete('/admin/rooms/{id}', [RoomController::class, 'destroy'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.rooms.destroy');

//Reservations

Route::post('/reservations', [ReservationController::class, 'store'])
    ->middleware(['auth', 'role:user'])
    ->name('reservations.store');

    Route::get('/reservations/create', [ReservationController::class, 'create'])
    ->middleware(['auth', 'role:user'])
    ->name('reservations.create');

    // View customer's reservations
Route::get('/my-reservations', [ReservationController::class, 'index'])
    ->middleware(['auth', 'role:user'])
    ->name('reservations.index');

    // Staff: View all reservations
Route::get('/staff/reservations', [ReservationController::class, 'staffIndex'])
    ->middleware(['auth', 'role:staff'])
    ->name('staff.reservations.index');

    // Approve a reservation
Route::patch('/staff/reservations/{id}/approve', [ReservationController::class, 'confirm'])
    ->middleware(['auth', 'role:staff'])
    ->name('staff.reservations.confirm');

// Deny a reservation
Route::patch('/staff/reservations/{id}/deny', [ReservationController::class, 'deny'])
    ->middleware(['auth', 'role:staff'])
    ->name('staff.reservations.deny');