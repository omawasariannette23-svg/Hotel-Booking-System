
@extends('layouts.app')

@section('title', 'Explore Our Rooms')

@section('content')

<style>
    .rooms-page {
        max-width: 1200px;
        margin: 20px auto;
        padding: 10px;
    }

    .rooms-heading {
        text-align: center;
        margin-bottom: 35px;
    }

    .rooms-heading h1 {
        color: #4b382a;
        font-family: Georgia, serif;
        font-size: 36px;
    }

    .rooms-heading p {
        color: #777;
    }

    .search-panel {
        background: #f7f1e8;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 25px;
    }

    .search-panel h3 {
        color: #4b382a;
        margin-top: 0;
    }

    .search-fields {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: end;
    }

    .search-field {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .search-field input {
        padding: 10px;
        border: 1px solid #cbbda9;
        border-radius: 5px;
    }

    .search-btn {
        background: #8b6b3f;
        color: white;
        border: none;
        padding: 11px 18px;
        border-radius: 5px;
        cursor: pointer;
    }

    .clear-link {
        color: #765b35;
        padding: 10px;
    }

    .dashboard-link {
        display: inline-block;
        color: #765b35;
        margin-bottom: 20px;
    }

    .room-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
        gap: 25px;
        margin-top: 25px;
    }

    .room-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        border: 1px solid #eee5d9;
    }

    .room-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
    }

    .no-image {
        height: 220px;
        background: #e9e0d4;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #806e5b;
    }

    .room-info {
        padding: 20px;
    }

    .room-info h2 {
        color: #4b382a;
        font-family: Georgia, serif;
        margin-top: 0;
    }

    .room-info p {
        color: #666;
        margin: 9px 0;
    }

    .room-price {
        color: #8b6b3f !important;
        font-size: 20px;
        font-weight: bold;
        margin-top: 15px !important;
    }

    .availability {
        margin: 15px 0;
        padding: 10px;
        border-radius: 5px;
        font-size: 14px;
    }

    .available {
        background: #e7f3e8;
        color: #286b36;
    }

    .booked {
        background: #f9e7e5;
        color: #a12d25;
    }

    .not-searched {
        background: #f2eee8;
        color: #78654e;
    }

    .room-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    .details-btn,
    .reserve-btn {
        display: inline-block;
        text-decoration: none;
        padding: 10px 14px;
        border-radius: 5px;
        text-align: center;
        font-size: 14px;
    }

    .details-btn {
        border: 1px solid #8b6b3f;
        color: #765b35;
    }

    .reserve-btn {
        background: #8b6b3f;
        color: white;
    }

    .validation-errors {
        color: #b83232;
        margin-bottom: 20px;
    }

    .empty-rooms {
        text-align: center;
        padding: 35px;
        color: #777;
    }

    @media (max-width: 600px) {
        .rooms-heading h1 {
            font-size: 28px;
        }

        .search-fields {
            flex-direction: column;
            align-items: stretch;
        }

        .search-field input {
            width: 100%;
            box-sizing: border-box;
        }
    }
</style>

<div class="rooms-page">

    <div class="rooms-heading">
        <h1>Discover Your Stay</h1>
        <p>Find the perfect room for your next relaxing getaway.</p>
    </div>

    {{-- Date Search --}}
    <div class="search-panel">

        <h3>Check Room Availability</h3>

        <form action="{{ route('rooms.available') }}" method="GET">

            <div class="search-fields">

                <div class="search-field">
                    <label for="check_in">Check-in Date</label>
                    <input
                        type="date"
                        name="check_in"
                        id="check_in"
                        value="{{ request('check_in') }}"
                        min="{{ date('Y-m-d') }}"
                        required
                    >
                </div>

                <div class="search-field">
                    <label for="check_out">Check-out Date</label>
                    <input
                        type="date"
                        name="check_out"
                        id="check_out"
                        value="{{ request('check_out') }}"
                        min="{{ date('Y-m-d') }}"
                        required
                    >
                </div>

                <button type="submit" class="search-btn">
                    Search Availability
                </button>

                <a href="{{ route('rooms.available') }}" class="clear-link">
                    Clear Search
                </a>

            </div>

        </form>

    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="validation-errors">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- Back to Dashboard --}}
    @if (auth()->user()->role === 'admin')
        <a class="dashboard-link" href="{{ route('admin.dashboard') }}">
            ← Back to Dashboard
        </a>
    @elseif (auth()->user()->role === 'staff')
        <a class="dashboard-link" href="{{ route('staff.dashboard') }}">
            ← Back to Dashboard
        </a>
    @else
        <a class="dashboard-link" href="{{ route('user.dashboard') }}">
            ← Back to Dashboard
        </a>
    @endif

    {{-- Availability Heading --}}
    @if ($validated)
        <h2>
            Available Rooms for
            {{ \Carbon\Carbon::parse($validated['check_in'])->format('M d, Y') }}
            –
            {{ \Carbon\Carbon::parse($validated['check_out'])->format('M d, Y') }}
        </h2>
    @else
        <h2>Explore Our Rooms</h2>
        <p>Select your dates to check which rooms are available.</p>
    @endif

    {{-- Room Cards --}}
    <div class="room-grid">

        @forelse ($rooms as $room)

            <div class="room-card">

                {{-- Room Photo --}}
                @if ($room->image)
                    <img
                        src="{{ asset('storage/' . $room->image) }}"
                        alt="Room {{ $room->room_number }}"
                        class="room-image"
                    >
                @else
                    <div class="no-image">
                        Room Photo Coming Soon
                    </div>
                @endif

                <div class="room-info">

                    <h2>{{ $room->room_class }}</h2>

                    <p>
                        <strong>Room Number:</strong>
                        {{ $room->room_number }}
                    </p>

                    <p>
                        <strong>Bed Type:</strong>
                        {{ $room->bed_type }}
                    </p>

                    <p>
                        <strong>Maximum Guests:</strong>
                        {{ $room->max_occupancy }}
                    </p>

                    <p>
                        <strong>View:</strong>
                        {{ $room->view_type }}
                    </p>

                    <p class="room-price">
                        ₱{{ number_format($room->price_per_night, 2) }}
                        <small>/ night</small>
                    </p>

                    {{-- Availability --}}
                    @if ($validated)

                        @if ($room->has_conflict)
                            <div class="availability booked">
                                Already booked for your selected dates.
                            </div>
                        @else
                            <div class="availability available">
                                Available for your selected dates!
                            </div>
                        @endif

                    @else

                        <div class="availability not-searched">
                            Select dates to check availability.
                        </div>

                    @endif

                    {{-- Actions --}}
                    <div class="room-actions">

                        {{-- FIXED: Pass selected dates to Room Details --}}
                        <a
                            href="{{ route('rooms.show', [
                                'room' => $room->id,
                                'check_in' => $validated['check_in'] ?? null,
                                'check_out' => $validated['check_out'] ?? null
                            ]) }}"
                            class="details-btn"
                        >
                            View Details
                        </a>

                        {{-- Direct Reservation --}}
                        @if ($validated && !$room->has_conflict && auth()->user()->role === 'user')

                            <a
                                href="{{ route('reservations.create', [
                                    'room_id' => $room->id,
                                    'check_in' => $validated['check_in'],
                                    'check_out' => $validated['check_out']
                                ]) }}"
                                class="reserve-btn"
                            >
                                Reserve Room
                            </a>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="empty-rooms">
                <h3>No operational rooms available</h3>
                <p>Please check again later.</p>
            </div>

        @endforelse

    </div>

</div>

@endsection
