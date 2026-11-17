
@extends('layouts.app')

@section('title', 'Make a Reservation')

@section('content')

<style>
    .reservation-container {
        max-width: 700px;
        margin: 30px auto;
        padding: 30px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .reservation-container h2 {
        color: #4b382a;
        font-family: Georgia, serif;
        margin-bottom: 25px;
    }

    .reservation-field {
        margin-bottom: 20px;
    }

    .reservation-field label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #4b382a;
    }

    .reservation-field input,
    .reservation-field select {
        width: 100%;
        padding: 12px;
        border: 1px solid #cbbda9;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .submit-button {
        background: #8b6b3f;
        color: white;
        border: none;
        padding: 13px 22px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 15px;
    }

    .back-link {
        display: inline-block;
        margin-bottom: 20px;
        color: #765b35;
    }

    .success-message {
        color: green;
        background: #e7f3e8;
        padding: 12px;
        border-radius: 5px;
    }

    .error-message {
        color: #b83232;
        background: #f9e7e5;
        padding: 12px 25px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
</style>

<div class="reservation-container">

    <a href="{{ route('user.dashboard') }}" class="back-link">
        ← Back to Dashboard
    </a>

    <h2>Make a Reservation</h2>

    {{-- Success Message --}}
    @if (session('success'))
        <p class="success-message">
            {{ session('success') }}
        </p>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="error-message">
            <strong>Please correct the following:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Reservation Form --}}
    <form action="{{ route('reservations.store') }}" method="POST">

        @csrf

        {{-- Select Room --}}
        <div class="reservation-field">

            <label for="room_id">Select Room:</label>

            <select name="room_id" id="room_id" required>

                <option value="">Choose a room</option>

                @foreach ($rooms as $room)

                    <option
                        value="{{ $room->id }}"
                        {{ old('room_id', $selectedRoomId ?? request('room_id')) == $room->id ? 'selected' : '' }}
                    >
                        Room {{ $room->room_number }}
                        - {{ $room->room_class }}
                        - ₱{{ number_format($room->price_per_night, 2) }} per night
                    </option>

                @endforeach

            </select>

        </div>

        {{-- Check-in Date --}}
        <div class="reservation-field">

            <label for="check_in">Check-in Date:</label>

            <input
                type="date"
                name="check_in"
                id="check_in"
                value="{{ old('check_in', $checkIn ?? request('check_in')) }}"
                min="{{ date('Y-m-d') }}"
                required
            >

        </div>

        {{-- Check-out Date --}}
        <div class="reservation-field">

            <label for="check_out">Check-out Date:</label>

            <input
                type="date"
                name="check_out"
                id="check_out"
                value="{{ old('check_out', $checkOut ?? request('check_out')) }}"
                min="{{ date('Y-m-d') }}"
                required
            >

        </div>

        <button type="submit" class="submit-button">
            Submit Reservation
        </button>

    </form>

</div>

@endsection
