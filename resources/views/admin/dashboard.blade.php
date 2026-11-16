
@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

    <h2>Admin Dashboard</h2>

    <p>Welcome, Administrator!</p>

    <hr>

    <h3>Hotel Management</h3>

    <a href="{{ route('admin.rooms.index') }}">
        Manage Rooms
    </a>

    <br><br>

    <h3>Hotel Operations</h3>

    <a href="{{ route('rooms.available') }}">
        View Available Rooms
    </a>

    <br><br>

    <a href="{{ route('staff.reservations.index') }}">
        Manage Customer Reservations
    </a>

    <br><br>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

@endsection
