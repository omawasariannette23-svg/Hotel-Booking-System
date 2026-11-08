
@extends('layouts.app')

@section('title', 'Customer Dashboard')

@section('content')

    <h2>Customer Dashboard</h2>
    <br>
    <p>Welcome to your account!</p>

<hr>
    <h3>Hotel Services</h3>

    <a href="{{ route('rooms.available') }}">View Available Rooms |</a>
    <a href="{{ route('reservations.create') }}"> Make a Reservation |</a>
    <a href="{{ route('reservations.index') }}"> My Reservations |</a>

<hr>
   
<br><br>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

@endsection
