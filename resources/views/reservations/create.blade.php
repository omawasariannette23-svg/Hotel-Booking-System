
@extends('layouts.app')

@section('title', 'Make a Reservation')

@section('content')

    <a href="{{ route('user.dashboard') }}">Back to Dashboard</a>

    <h2>Make a Reservation</h2>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf

        <label for="room_id">Select Room:</label>

        <select name="room_id" id="room_id" required>

            <option value="">Choose a room</option>

            @foreach ($rooms as $room)
                <option
                    value="{{ $room->id }}"
                    {{ old('room_id', $selectedRoomId) == $room->id ? 'selected' : '' }}
                >
                    Room {{ $room->room_number }}
                    - {{ $room->room_class }}
                    - ₱{{ $room->price_per_night }} per night
                </option>
            @endforeach

        </select>

        <br><br>

        <label for="check_in">Check-in Date:</label>

        <input
            type="date"
            name="check_in"
            id="check_in"
            value="{{ old('check_in', $checkIn) }}"
            required
        >

        <br><br>

        <label for="check_out">Check-out Date:</label>

        <input
            type="date"
            name="check_out"
            id="check_out"
            value="{{ old('check_out', $checkOut) }}"
            required
        >

        <br><br>

        <button type="submit">Submit Reservation</button>

    </form>

@endsection
