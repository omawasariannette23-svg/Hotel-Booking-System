
@extends('layouts.app')

@section('title', 'Manage Reservations')
@section('main-class', 'wide-main')

@section('content')

<style>
    .reservations-page {
        color: #243b53;
        width: 100%;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .page-title {
        color: #183b56;
        font-size: 30px;
        font-weight: 700;
        margin: 0 0 6px;
    }

    .page-subtitle {
        color: #627d98;
        margin: 0;
        font-size: 14px;
    }

    .history-link {
        display: inline-block;
        background: #183b56;
        color: white;
        padding: 11px 18px;
        border-radius: 7px;
        text-decoration: none;
        font-weight: 600;
    }

    .history-link:hover {
        background: #254f70;
        color: white;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .summary-card {
        background: white;
        border: 1px solid #d9e2ec;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.04);
    }

    .summary-card p {
        color: #627d98;
        margin: 0 0 8px;
        font-size: 14px;
    }

    .summary-card h2 {
        color: #183b56;
        font-size: 29px;
        margin: 0;
    }

    .filters-card {
        background: white;
        border: 1px solid #d9e2ec;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 22px;
    }

    .filters-title {
        font-size: 18px;
        font-weight: 700;
        color: #183b56;
        margin: 0 0 15px;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr auto auto;
        gap: 12px;
        align-items: end;
    }

    .filter-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 6px;
        color: #486581;
    }

    .filter-group input,
    .filter-group select {
        width: 100%;
        height: 42px;
        padding: 8px 10px;
        border: 1px solid #bcccdc;
        border-radius: 6px;
        font-size: 14px;
        color: #243b53;
        background: white;
    }

    .filter-button,
    .reset-button {
        height: 42px;
        padding: 0 17px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
        font-size: 14px;
    }

    .filter-button {
        background: #183b56;
        color: white;
    }

    .filter-button:hover {
        background: #254f70;
    }

    .reset-button {
        background: #e6edf3;
        color: #334e68;
    }

    .reset-button:hover {
        background: #d9e2ec;
    }

    .table-card {
        background: white;
        border: 1px solid #d9e2ec;
        border-radius: 10px;
        overflow: hidden;
    }

    .table-heading {
        padding: 18px 20px;
        border-bottom: 1px solid #d9e2ec;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .table-heading h2 {
        font-size: 19px;
        color: #183b56;
        margin: 0;
    }

    .table-heading span {
        color: #627d98;
        font-size: 13px;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .reservations-table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
    }

    .reservations-table th {
        background: #f0f4f8;
        color: #334e68;
        font-size: 13px;
        font-weight: 700;
        padding: 15px 13px;
        text-align: left;
        white-space: nowrap;
    }

    .reservations-table td {
        padding: 15px 13px;
        border-top: 1px solid #e6edf3;
        font-size: 14px;
        vertical-align: middle;
    }

    .reservations-table tr:hover td {
        background: #f8fafc;
    }

    .booking-reference {
        color: #183b56;
        font-weight: 700;
        white-space: nowrap;
    }

    .customer-name {
        font-weight: 600;
        color: #243b53;
    }

    .customer-email {
        color: #829ab1;
        font-size: 12px;
        margin-top: 3px;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-confirmed {
        background: #d1ecf1;
        color: #0c5460;
    }

    .status-checked_in {
        background: #d4edda;
        color: #155724;
    }

    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        min-width: 150px;
        align-items: center;
    }

    .action-button {
        border: none;
        border-radius: 5px;
        padding: 7px 10px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        color: white;
    }

    .approve-button {
        background: #287a55;
    }

    .deny-button {
        background: #b83b3b;
    }

    .checkin-button {
        background: #287a55;
    }

    .checkout-button {
        background: #315f86;
    }

    .action-button:hover {
        opacity: 0.85;
    }

    .action-note {
        color: #627d98;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .empty-state {
        text-align: center;
        padding: 45px 20px;
        color: #829ab1;
        font-size: 15px;
    }

    .pagination-container {
        padding: 18px 20px;
        border-top: 1px solid #e6edf3;
    }

    .pagination-container nav {
        display: flex;
        justify-content: center;
    }

    @media (max-width: 1000px) {
        .filter-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .summary-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 600px) {
        .summary-grid {
            grid-template-columns: 1fr;
        }

        .filter-grid {
            grid-template-columns: 1fr;
        }

        .page-title {
            font-size: 25px;
        }
    }
</style>

<div class="reservations-page">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Manage Reservations</h1>
            <p class="page-subtitle">
                View and manage all active customer reservations.
            </p>
        </div>

        <a href="{{ route('staff.reservations.history') }}" class="history-link">
            View Reservation History
        </a>
    </div>

    {{-- SUMMARY CARDS --}}
    <div class="summary-grid">

        <div class="summary-card">
            <p>Pending Reservations</p>
            <h2>{{ $pendingCount }}</h2>
        </div>

        <div class="summary-card">
            <p>Confirmed Reservations</p>
            <h2>{{ $confirmedCount }}</h2>
        </div>

        <div class="summary-card">
            <p>Currently Checked In</p>
            <h2>{{ $checkedInCount }}</h2>
        </div>

    </div>

    {{-- FILTERS --}}
    <div class="filters-card">

        <h2 class="filters-title">Search and Filter Reservations</h2>

        <form action="{{ route('staff.reservations.index') }}" method="GET">

            <div class="filter-grid">

                <div class="filter-group">
                    <label for="search">Search</label>
                    <input
                        type="text"
                        id="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Booking reference or customer name"
                    >
                </div>

                <div class="filter-group">
                    <label for="month">Check-in Month</label>
                    <select name="month" id="month">
                        <option value="">All Months</option>

                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}"
                                {{ request('month') == $month ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label for="year">Check-in Year</label>
                    <select name="year" id="year">
                        <option value="">All Years</option>

                        @foreach(range(now()->year - 2, now()->year + 2) as $year)
                            <option value="{{ $year }}"
                                {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label for="status">Status</label>
                    <select name="status" id="status">
                        <option value="">All Active</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>
                            Confirmed
                        </option>
                        <option value="checked_in" {{ request('status') == 'checked_in' ? 'selected' : '' }}>
                            Checked In
                        </option>
                    </select>
                </div>

                <button type="submit" class="filter-button">
                    Apply Filters
                </button>

                <a href="{{ route('staff.reservations.index') }}" class="reset-button">
                    Reset
                </a>

            </div>

        </form>
    </div>

    {{-- RESERVATIONS TABLE --}}
    <div class="table-card">

        <div class="table-heading">
            <h2>Active Reservations</h2>
            <span>{{ $reservations->total() }} reservation(s) found</span>
        </div>

        <div class="table-responsive">

            <table class="reservations-table">

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

                    @forelse($reservations as $reservation)

                        <tr>

                            <td>
                                <span class="booking-reference">
                                    {{ $reservation->booking_reference }}
                                </span>
                            </td>

                            <td>
                                <div class="customer-name">
                                    {{ $reservation->user->first_name }}
                                    {{ $reservation->user->last_name }}
                                </div>

                                <div class="customer-email">
                                    {{ $reservation->user->email }}
                                </div>
                            </td>

                            <td>
                                {{ $reservation->room->room_number }}
                                <br>
                                <small>{{ $reservation->room->room_class }}</small>
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($reservation->check_in)->format('M d, Y') }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($reservation->check_out)->format('M d, Y') }}
                            </td>

                            <td>
                                ₱{{ number_format($reservation->total_amount, 2) }}
                            </td>

                            <td>
                                <span class="status-badge status-{{ $reservation->booking_status }}">
                                    {{ ucfirst(str_replace('_', ' ', $reservation->booking_status)) }}
                                </span>
                            </td>

                            <td>
                                <div class="action-buttons">

                                    @if($reservation->booking_status === 'pending')

                                        <form action="{{ route('staff.reservations.confirm', $reservation->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" class="action-button approve-button">
                                                Approve
                                            </button>
                                        </form>

                                        <form action="{{ route('staff.reservations.deny', $reservation->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" class="action-button deny-button">
                                                Deny
                                            </button>
                                        </form>

                                    @elseif($reservation->booking_status === 'confirmed')

                                        @php
                                            $today = now()->toDateString();
                                            $checkInDate = \Carbon\Carbon::parse($reservation->check_in)->toDateString();
                                            $checkOutDate = \Carbon\Carbon::parse($reservation->check_out)->toDateString();
                                        @endphp

                                        @if($today < $checkInDate)

                                            <span class="action-note">
                                                Upcoming
                                            </span>

                                        @elseif($today >= $checkInDate && $today < $checkOutDate)

                                            <form action="{{ route('staff.reservations.checkin', $reservation->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit" class="action-button checkin-button">
                                                    Check In
                                                </button>
                                            </form>

                                        @else

                                            <span class="action-note">
                                                Check-in period ended
                                            </span>

                                        @endif

                                    @elseif($reservation->booking_status === 'checked_in')

                                        <form action="{{ route('staff.reservations.checkout', $reservation->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" class="action-button checkout-button">
                                                Check Out
                                            </button>
                                        </form>

                                    @endif

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    No active reservations found.
                                    <br>
                                    Try changing your search or filters.
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if($reservations->hasPages())
            <div class="pagination-container">
                {{ $reservations->links() }}
            </div>
        @endif

    </div>

</div>

@endsection
