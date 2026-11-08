
@extends('layouts.app')

@section('title', 'Available Rooms')

@section('content')

    <h2>Available Hotel Rooms</h2>

    <p>Browse our rooms and select your preferred dates to check availability.</p>

    {{-- Date Search Form --}}
    <form action="{{ route('rooms.available') }}" method="GET">

        <label for="check_in">Check-in Date:</label>
        <input
            type="date"
            name="check_in"
            id="check_in"
            value="{{ request('check_in') }}"
            min="{{ date('Y-m-d') }}"
            required
        >

        <br><br>

        <label for="check_out">Check-out Date:</label>
        <input
            type="date"
            name="check_out"
            id="check_out"
            value="{{ request('check_out') }}"
            min="{{ date('Y-m-d') }}"
            required
        >

        <br><br>

        <button type="submit">Search Availability</button>

        <a href="{{ route('rooms.available') }}">Clear Search</a>

    </form>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <br>

    {{-- Back to Dashboard --}}
    @if (auth()->user()->role === 'admin')
        <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
    @elseif (auth()->user()->role === 'staff')
        <a href="{{ route('staff.dashboard') }}">Back to Dashboard</a>
    @else
        <a href="{{ route('user.dashboard') }}">Back to Dashboard</a>
    @endif

    <hr>

    {{-- Availability Results --}}
    @if ($validated)
        <h3>
            Room Availability:
            {{ $validated['check_in'] }}
            to
            {{ $validated['check_out'] }}
        </h3>
    @else
        <p>Select your preferred dates to check room availability.</p>
    @endif

    {{-- Display Rooms --}}
    @forelse ($rooms as $room)

        <div>

            <h3>Room {{ $room->room_number }}</h3>

            <p>Class: {{ $room->room_class }}</p>

            <p>Bed Type: {{ $room->bed_type }}</p>

            <p>Maximum Occupancy: {{ $room->max_occupancy }}</p>

            <p>View: {{ $room->view_type }}</p>

            <p>
                Price per Night:
                ₱{{ number_format($room->price_per_night, 2) }}
            </p>

            {{-- Display Availability --}}
            @if ($validated)

                @if ($room->has_conflict)

                    <p style="color: red;">
                        Already Booked for Selected Dates
                    </p>

                @else

                    <p style="color: green;">
                        Available for Selected Dates
                    </p>

                    <a href="{{ route('reservations.create', [
                        'room_id' => $room->id,
                        'check_in' => $validated['check_in'],
                        'check_out' => $validated['check_out']
                    ]) }}">
                        Reserve This Room
                    </a>

                @endif

            @else

                <p>Select dates to check availability.</p>

            @endif

        </div>

        <hr>

    @empty

        <p>No operational rooms available at the moment.</p>

    @endforelse

@endsection
