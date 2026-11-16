
@extends('layouts.app')

@section('title', 'My Reservations')

@section('content')

    <h2>My Reservations</h2>

    {{-- Success and error messages --}}
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

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
                    <th>Actual Check-in</th>
                    <th>Actual Check-out</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->booking_reference }}</td>

                        <td>
                            {{ $reservation->room->room_number }}
                            ({{ $reservation->room->room_class }})
                        </td>

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
                            @if ($reservation->booking_status === 'pending')
                                <span style="color: orange;">Pending</span>

                            @elseif ($reservation->booking_status === 'confirmed')
                                <span style="color: green;">Confirmed</span>

                            @elseif ($reservation->booking_status === 'checked_in')
                                <span style="color: blue;">Checked In</span>

                            @elseif ($reservation->booking_status === 'completed')
                                <span style="color: green;">Completed</span>

                            @elseif ($reservation->booking_status === 'cancelled')
                                <span style="color: red;">Cancelled</span>
                            @endif
                        </td>

                        <td>
                            @if (in_array($reservation->booking_status, ['pending', 'confirmed']))
                                <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to cancel this reservation?')">
                                        Cancel
                                    </button>
                                </form>
                            @else
                                No action available
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
