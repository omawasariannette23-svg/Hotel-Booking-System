<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// About Us
Route::get('/about', function () {
    return view('about');
})->name('about');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

// Registration
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| DASHBOARDS
|--------------------------------------------------------------------------
*/

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


/*
|--------------------------------------------------------------------------
| AVAILABLE ROOMS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:user,staff,admin'])->group(function () {

    // View Available Rooms
    Route::get('/rooms', [RoomController::class, 'available'])
        ->name('rooms.available');

    // View Individual Room
    Route::get('/rooms/{room}', [RoomController::class, 'show'])
        ->name('rooms.show');

});


/*
|--------------------------------------------------------------------------
| ADMIN ROOM MANAGEMENT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin/rooms')
    ->name('admin.rooms.')
    ->group(function () {

        // View All Rooms
        Route::get('/', [RoomController::class, 'index'])
            ->name('index');

        // Add Room Form
        Route::get('/create', [RoomController::class, 'create'])
            ->name('create');

        // Save New Room
        Route::post('/', [RoomController::class, 'store'])
            ->name('store');

        // Edit Room Form
        Route::get('/{id}/edit', [RoomController::class, 'edit'])
            ->name('edit');

        // Update Room
        Route::put('/{id}', [RoomController::class, 'update'])
            ->name('update');

        // Delete Room
        Route::delete('/{id}', [RoomController::class, 'destroy'])
            ->name('destroy');

    });


/*
|--------------------------------------------------------------------------
| CUSTOMER RESERVATIONS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:user'])->group(function () {

    // Reservation Form
    Route::get('/reservations/create', [ReservationController::class, 'create'])
        ->name('reservations.create');

    // Save Reservation
    Route::post('/reservations', [ReservationController::class, 'store'])
        ->name('reservations.store');

    // View My Reservations
    Route::get('/my-reservations', [ReservationController::class, 'index'])
        ->name('reservations.index');

    // Cancel Reservation
    Route::patch('/my-reservations/{id}/cancel', [ReservationController::class, 'cancel'])
        ->name('reservations.cancel');

});


/*
|--------------------------------------------------------------------------
| STAFF AND ADMIN RESERVATION MANAGEMENT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:staff,admin'])
    ->prefix('staff/reservations')
    ->name('staff.reservations.')
    ->group(function () {

        // Active Reservations
        Route::get('/', [ReservationController::class, 'staffIndex'])
            ->name('index');

        // Reservation History
        Route::get('/history', [ReservationController::class, 'staffHistory'])
            ->name('history');

        // Approve Reservation
        Route::patch('/{id}/approve', [ReservationController::class, 'confirm'])
            ->name('confirm');

        // Deny Reservation
        Route::patch('/{id}/deny', [ReservationController::class, 'deny'])
            ->name('deny');

        // Check In
        Route::patch('/{id}/check-in', [ReservationController::class, 'checkIn'])
            ->name('checkin');

        // Check Out
        Route::patch('/{id}/check-out', [ReservationController::class, 'checkOut'])
            ->name('checkout');

    });
