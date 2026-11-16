
@extends('layouts.app')

@section('title', 'Manage Reservations')

@section('content')

    {{-- Back to the correct dashboard --}}
    @if (auth()->user()->role === 'admin')
        <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
    @else
        <a href="{{ route('staff.dashboard') }}">Back to Dashboard</a>
    @endif

    <h2>Manage Customer Reservations</h2>

    {{-- Success and error messages --}}
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    @if ($reservations->isEmpty())

        <p>No reservations found.</p>

    @else

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Booking Reference</th>
                    <th>Customer</th>
                    <th>Room</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Actual Check-in</th>
                    <th>Actual Check-out</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->booking_reference }}</td>

                        <td>
                            {{ $reservation->user->first_name }}
                            {{ $reservation->user->last_name }}
                        </td>

                        <td>{{ $reservation->room->room_number }}</td>
                        <td>{{ $reservation->check_in }}</td>
                        <td>{{ $reservation->check_out }}</td>

                        <td>
                            {{ $reservation->actual_check_in ?? 'Not checked in' }}
                        </td>

                        <td>
                            {{ $reservation->actual_check_out ?? 'Not checked out' }}
                        </td>

                        <td>
                            ₱{{ number_format($reservation->total_amount, 2) }}
                        </td>

                        <td>
                            {{ ucfirst(str_replace('_', ' ', $reservation->booking_status)) }}
                        </td>

                        <td>

                            {{-- Pending Reservation --}}
                            @if ($reservation->booking_status === 'pending')

                                <form action="{{ route('staff.reservations.confirm', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit">Approve</button>
                                </form>

                                <form action="{{ route('staff.reservations.deny', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit">Deny</button>
                                </form>

                            {{-- Confirmed Reservation --}}
                            @elseif ($reservation->booking_status === 'confirmed')

                                @if (today()->gte($reservation->check_in) && today()->lt($reservation->check_out))

                                    <form action="{{ route('staff.reservations.checkin', $reservation->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit">Check In</button>
                                    </form>

                                @elseif (today()->gte($reservation->check_out))

                                    Check-in Period Expired

                                @else

                                    Not Yet Available

                                @endif

                            {{-- Checked-In Reservation --}}
                            @elseif ($reservation->booking_status === 'checked_in')

                                <form action="{{ route('staff.reservations.checkout', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit">Check Out</button>
                                </form>

                            {{-- Completed Reservation --}}
                            @elseif ($reservation->booking_status === 'completed')

                                Stay Completed

                            {{-- Cancelled Reservation --}}
                            @elseif ($reservation->booking_status === 'cancelled')

                                Cancelled

                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif

@endsection
    