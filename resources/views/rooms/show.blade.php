
@extends('layouts.app')

@section('title', 'Room Details')

@section('content')

<style>
    .details-container {
        max-width: 1000px;
        margin: 30px auto;
        padding: 20px;
    }

    .details-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .details-image {
        width: 100%;
        height: 450px;
        object-fit: cover;
        display: block;
    }

    .no-image {
        height: 350px;
        background: #e9e0d4;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #806e5b;
    }

    .details-content {
        padding: 30px;
    }

    .details-content h1 {
        color: #4b382a;
        font-family: Georgia, serif;
    }

    .details-content p {
        color: #666;
        margin: 12px 0;
    }

    .details-price {
        color: #8b6b3f !important;
        font-size: 25px;
        font-weight: bold;
    }

    .details-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 25px;
    }

    .reserve-button {
        background: #8b6b3f;
        color: white;
        padding: 12px 22px;
        border-radius: 5px;
        text-decoration: none;
    }

    .back-button {
        color: #765b35;
        padding: 12px;
    }
</style>

@php
    $checkIn = request()->query('check_in');
    $checkOut = request()->query('check_out');
@endphp

<div class="details-container">

    <div class="details-card">

        {{-- Room Photo --}}
        @if ($room->image)

            <img
                src="{{ asset('storage/' . $room->image) }}"
                alt="Room {{ $room->room_number }}"
                class="details-image"
            >

        @else

            <div class="no-image">
                No room photo available.
            </div>

        @endif

        <div class="details-content">

            <h1>{{ $room->room_class }}</h1>

            <p>
                <strong>Room Number:</strong>
                {{ $room->room_number }}
            </p>

            <p>
                <strong>Bed Type:</strong>
                {{ $room->bed_type }}
            </p>

            <p>
                <strong>Maximum Occupancy:</strong>
                {{ $room->max_occupancy }} guests
            </p>

            <p>
                <strong>Room View:</strong>
                {{ $room->view_type }}
            </p>

            <p class="details-price">
                ₱{{ number_format($room->price_per_night, 2) }}
                <small>/ night</small>
            </p>

            <p>
                <strong>Room Status:</strong>
                {{ ucfirst($room->status) }}
            </p>

            <div class="details-actions">

                @if (auth()->user()->role === 'user' && $room->status === 'available')

                    <a
                        href="{{ route('reservations.create', [
                            'room_id' => $room->id,
                            'check_in' => $checkIn,
                            'check_out' => $checkOut
                        ]) }}"
                        class="reserve-button"
                    >
                        Reserve This Room
                    </a>

                @endif

                <a
                    href="{{ route('rooms.available', [
                        'check_in' => $checkIn,
                        'check_out' => $checkOut
                    ]) }}"
                    class="back-button"
                >
                    ← Back to Rooms
                </a>

            </div>

        </div>

    </div>

</div>

@endsection
