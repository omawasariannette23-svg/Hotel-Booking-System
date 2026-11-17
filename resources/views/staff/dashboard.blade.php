
@extends('layouts.app')

@section('title', 'Staff Dashboard')

@section('main-class', 'staff-dashboard-main')

@section('content')

<style>
    /* WHITE DASHBOARD BACKGROUND */

    main.staff-dashboard-main {
        background: #ffffff;
        min-height: 100vh;
    }

    main.staff-dashboard-main .page-container {
        max-width: 1150px;
        margin: 0 auto;
        padding: 55px 30px;
        background: #ffffff;
        box-shadow: none;
    }

    .staff-dashboard {
        width: 100%;
    }

    /* DASHBOARD HEADING */

    .dashboard-heading {
        color: #183b56;
        font-size: 38px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .dashboard-subtitle {
        color: #617589;
        font-size: 17px;
        margin-bottom: 25px;
        line-height: 1.6;
    }

    .heading-line {
        width: 110px;
        height: 5px;
        background-color: #d6ad72;
        margin-bottom: 40px;
        border-radius: 5px;
    }

    .section-heading {
        color: #183b56;
        font-size: 25px;
        margin-bottom: 22px;
    }

    /* DASHBOARD CARDS */

    .dashboard-list {
        display: flex;
        flex-direction: column;
        gap: 28px;
    }

    .dashboard-card {
        position: relative;
        min-height: 260px;
        border-radius: 14px;
        overflow: hidden;
        display: flex;
        align-items: center;
        padding: 35px 40px;
        background-size: cover;
        background-position: center;
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.16);
        transition: transform 0.25s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
    }

    /* AVAILABLE ROOMS PHOTO */

    .rooms-card {
        background-image:
            linear-gradient(
                rgba(10, 30, 45, 0.62),
                rgba(10, 30, 45, 0.62)
            ),
            url("/images/view-photo.jfif");

        background-size: cover;
        background-position: center;
    }

    /* MANAGE RESERVATIONS PHOTO */

    .reservations-card {
        background-image:
            linear-gradient(
                rgba(10, 30, 45, 0.62),
                rgba(10, 30, 45, 0.62)
            ),
            url("/images/reservation-photo.jfif");

        background-size: cover;
        background-position: center;
    }

    /* CARD CONTENT */

    .card-content {
        position: relative;
        z-index: 1;
        max-width: 750px;
        color: white;
    }

    .card-content h4 {
        font-size: 29px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .card-description {
        font-size: 16px;
        line-height: 1.7;
        margin-bottom: 22px;
        color: #f0f4f8;
    }

    /* BUTTONS */

    .dashboard-button {
        display: inline-block;
        background-color: #ffffff;
        color: #183b56;
        text-decoration: none;
        padding: 13px 25px;
        border-radius: 30px;
        font-size: 15px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .dashboard-button:hover {
        background-color: #d6ad72;
        color: #183b56;
    }

    /* MOBILE RESPONSIVENESS */

    @media (max-width: 650px) {

        main.staff-dashboard-main .page-container {
            padding: 35px 18px;
        }

        .dashboard-heading {
            font-size: 31px;
        }

        .dashboard-subtitle {
            font-size: 15px;
        }

        .dashboard-card {
            min-height: 240px;
            padding: 25px;
        }

        .card-content h4 {
            font-size: 24px;
        }

        .card-description {
            font-size: 14px;
        }

        .dashboard-button {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="staff-dashboard">

    <h2 class="dashboard-heading">Staff Dashboard</h2>

    <p class="dashboard-subtitle">
        Manage room availability and customer reservations.
    </p>

    <div class="heading-line"></div>

    <h3 class="section-heading">Hotel Operations</h3>

    <div class="dashboard-list">

        <!-- AVAILABLE ROOMS -->

        <div class="dashboard-card rooms-card">

            <div class="card-content">

                <h4>Available Rooms</h4>

                <p class="card-description">
                    View room information, check room availability,
                    and review the hotel's accommodations.
                </p>

                <a
                    href="{{ route('rooms.available') }}"
                    class="dashboard-button"
                >
                    View Rooms →
                </a>

            </div>

        </div>

        <!-- MANAGE RESERVATIONS -->

        <div class="dashboard-card reservations-card">

            <div class="card-content">

                <h4>Manage Reservations</h4>

                <p class="card-description">
                    Review customer bookings and manage reservation
                    approvals, guest check-ins, and check-outs.
                </p>

                <a
                    href="{{ route('staff.reservations.index') }}"
                    class="dashboard-button"
                >
                    Manage Reservations →
                </a>

            </div>

        </div>

    </div>

</div>

@endsection
