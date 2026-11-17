
@extends('layouts.app')

@section('title', 'My Reservations')

@section('content')

<style>
    .my-reservations {
        width: 100%;
        color: #243b53;
    }

    .page-heading {
        color: #183b56;
        font-size: 29px;
        margin-bottom: 8px;
    }

    .page-description {
        color: #627d98;
        font-size: 16px;
        margin-bottom: 25px;
    }

    .back-link {
        display: inline-block;
        margin-bottom: 20px;
        color: #2874a6;
        text-decoration: none;
        font-size: 15px;
        font-weight: 600;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    .message {
        padding: 14px 16px;
        border-radius: 8px;
        margin-bottom: 18px;
        font-size: 15px;
    }

    .success-message {
        background: #e5f5ec;
        color: #216e45;
    }

    .error-message {
        background: #fdeaea;
        color: #a83232;
    }

    .table-container {
        width: 100%;
        background: white;
        border: 1px solid #d9e2ec;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(24, 59, 86, 0.06);
    }

    .reservation-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .reservation-table th {
        background: #183b56;
        color: white;
        padding: 18px 12px;
        text-align: left;
        font-size: 16px;
    }

    .reservation-table td {
        padding: 20px 12px;
        border-bottom: 1px solid #e8eef3;
        font-size: 15px;
        vertical-align: middle;
        overflow-wrap: anywhere;
    }

    .reservation-table tbody tr:hover {
        background: #f4f8fb;
    }

    .reservation-table tbody tr:last-child td {
        border-bottom: none;
    }

    .booking-reference {
        color: #183b56;
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .room-number {
        color: #183b56;
        font-size: 17px;
        font-weight: 700;
    }

    .date-info {
        line-height: 1.9;
    }

    .date-label {
        color: #829ab1;
        font-size: 13px;
        font-weight: 700;
    }

    .date-value {
        color: #334e68;
        font-size: 14px;
    }

    .muted {
        color: #829ab1;
        font-size: 13px;
    }

    .amount {
        color: #183b56;
        font-size: 16px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status {
        display: inline-block;
        padding: 9px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-confirmed {
        background: #dceeff;
        color: #185a8d;
    }

    .status-checked-in {
        background: #e5e0fa;
        color: #58449a;
    }

    .status-completed {
        background: #dff3e7;
        color: #247044;
    }

    .status-cancelled {
        background: #fce4e4;
        color: #a83232;
    }

    .empty-state {
        background: white;
        border: 1px solid #d9e2ec;
        border-radius: 12px;
        padding: 55px 20px;
        text-align: center;
    }

    .empty-state h3 {
        color: #183b56;
        font-size: 22px;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #627d98;
        font-size: 15px;
        margin-bottom: 20px;
    }

    .browse-button {
        display: inline-block;
        background: #183b56;
        color: white;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 7px;
        font-weight: 600;
    }

    .browse-button:hover {
        background: #245777;
    }

    @media (max-width: 900px) {
        .table-container {
            overflow: visible;
            border: none;
            box-shadow: none;
            background: transparent;
        }

        .reservation-table,
        .reservation-table tbody,
        .reservation-table tr,
        .reservation-table td {
            display: block;
            width: 100%;
        }

        .reservation-table thead {
            display: none;
        }

        .reservation-table tbody tr {
            background: white;
            border: 1px solid #d9e2ec;
            border-radius: 10px;
            margin-bottom: 18px;
            padding: 10px;
        }

        .reservation-table td {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            padding: 13px 5px;
            border-bottom: 1px solid #edf1f5;
            text-align: right;
        }

        .reservation-table td::before {
            content: attr(data-label);
            color: #183b56;
            font-weight: 700;
            text-align: left;
            flex-shrink: 0;
        }

        .reservation-table td:last-child {
            border-bottom: none;
        }
    }
</style>

<div class="my-reservations">

    <a href="{{ route('user.dashboard') }}" class="back-link">
        ← Back to Dashboard
    </a>

    <h2 class="page-heading">My Reservations</h2>

    <p class="page-description">
        View your bookings and check the status of your reservations.
    </p>

    @if (session('success'))
        <div class="message success-message">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="message error-message">
            {{ session('error') }}
        </div>
    @endif

    @if ($reservations->isEmpty())

        <div class="empty-state">
            <h3>You Have No Reservations Yet</h3>
            <p>Your bookings will appear here once you make a reservation.</p>

            <a href="{{ route('rooms.available') }}" class="browse-button">
                Browse Available Rooms
            </a>
        </div>

    @else

        <div class="table-container">

            <table class="reservation-table">

                <colgroup>
                    <col style="width: 20%">
                    <col style="width: 10%">
                    <col style="width: 20%">
                    <col style="width: 22%">
                    <col style="width: 14%">
                    <col style="width: 14%">
                </colgroup>

                <thead>
                    <tr>
                        <th>Booking Reference</th>
                        <th>Room</th>
                        <th>Stay Dates</th>
                        <th>Actual Stay</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($reservations as $reservation)

                        <tr>

                            <td data-label="Booking Reference">
                                <div class="booking-reference">
                                    {{ $reservation->booking_reference }}
                                </div>
                            </td>

                            <td data-label="Room">
                                <span class="room-number">
                                    {{ $reservation->room->room_number }}
                                </span>
                            </td>

                            <td data-label="Stay Dates">
                                <div class="date-info">
                                    <div>
                                        <span class="date-label">IN:</span>
                                        <span class="date-value">
                                            {{ $reservation->check_in->format('M d, Y') }}
                                        </span>
                                    </div>

                                    <div>
                                        <span class="date-label">OUT:</span>
                                        <span class="date-value">
                                            {{ $reservation->check_out->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td data-label="Actual Stay">
                                <div class="date-info">
                                    <div>
                                        <span class="date-label">IN:</span>

                                        @if ($reservation->actual_check_in)
                                            <span class="date-value">
                                                {{ $reservation->actual_check_in->format('M d, Y h:i A') }}
                                            </span>
                                        @else
                                            <span class="muted">Not checked in</span>
                                        @endif
                                    </div>

                                    <div>
                                        <span class="date-label">OUT:</span>

                                        @if ($reservation->actual_check_out)
                                            <span class="date-value">
                                                {{ $reservation->actual_check_out->format('M d, Y h:i A') }}
                                            </span>
                                        @else
                                            <span class="muted">Not checked out</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td data-label="Amount">
                                <span class="amount">
                                    ₱{{ number_format($reservation->total_amount, 2) }}
                                </span>
                            </td>

                            <td data-label="Status">
                                <span class="status status-{{ str_replace('_', '-', $reservation->booking_status) }}">
                                    {{ ucfirst(str_replace('_', ' ', $reservation->booking_status)) }}
                                </span>
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @endif

</div>

@endsection
