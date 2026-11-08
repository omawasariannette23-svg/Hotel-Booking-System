@extends('layouts.app')

@section('title', 'My Reservations')

@section('content')

    <h2>My Reservations</h2>

    @if ($reservations->isEmpty())
        <p>You have no reservations yet.</p>
    @else
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Booking Reference</th>
                    <th>Room</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->booking_reference }}</td>
                        <td>{{ $reservation->room->room_number }}</td>
                        <td>{{ $reservation->check_in }}</td>
                        <td>{{ $reservation->check_out }}</td>
                        <td>₱{{ number_format($reservation->total_amount, 2) }}</td>
                       <td>
                            @if ($reservation->booking_status === 'pending')
                                <span style="color: orange;">Pending</span>

                            @elseif ($reservation->booking_status === 'confirmed')
                                    <span style="color: green;">Approved</span>

                            @elseif ($reservation->booking_status === 'cancelled')
                                        <span style="color: red;">Denied</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <br>

    <a href="{{ route('user.dashboard') }}">Back to Dashboard</a>

@endsection