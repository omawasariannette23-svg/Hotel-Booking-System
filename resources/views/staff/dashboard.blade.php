@extends('layouts.app')

@section('title', 'Staff Dashboard')

@section('content')

    <h2>Staff Dashboard</h2>

    <p>Welcome to the Staff Dashboard!</p>

    <h3>Hotel Operations</h3>

    <a href="{{ route('rooms.available') }}">
        View Available Rooms
    </a>

    <br><br>

<a href="{{ route('staff.reservations.index') }}">
    Manage Reservations
</a>

    <br><br>
    

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

@endsection