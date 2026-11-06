<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;

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
    return 'Admin Dashboard';
})->middleware(['auth', 'role:admin']);

// Staff Dashboard
Route::get('/staff/dashboard', function () {
    return 'Staff Dashboard';
})->middleware(['auth', 'role:staff']);

// Customer Dashboard
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'role:user']);

Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('guest')
    ->name('register.submit');

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