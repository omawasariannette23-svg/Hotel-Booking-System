
@extends('layouts.app')

@section('title', 'Manage Reservations')

@section('content')

    <h2>Manage Customer Reservations</h2>

    {{-- Success and error messages --}}
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p>{{ session('error') }}</p>
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
                            ₱{{ number_format($reservation->total_amount, 2) }}
                        </td>

                        <td>
                            {{ ucfirst($reservation->booking_status) }}
                        </td>

                        <td>
                            @if ($reservation->booking_status === 'pending')

                                {{-- Approve reservation --}}
                                <form action="{{ route('staff.reservations.confirm', $reservation->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit">Approve</button>
                                </form>

                                {{-- Deny reservation --}}
                                <form action="{{ route('staff.reservations.deny', $reservation->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit">Deny</button>
                                </form>

                            @else

                                Already processed

                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif

@endsection
