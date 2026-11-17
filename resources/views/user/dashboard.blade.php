
@extends('layouts.app')

@section('title', 'Welcome | Hotel Booking System')

@section('content')

<style>
    /* CUSTOMER HERO */

    .customer-hero {
        min-height: 420px;
        border-radius: 10px;
        background:
            linear-gradient(rgba(15, 39, 57, 0.45), rgba(15, 39, 57, 0.45)),
            url("/images/hotel-hero.jpg") center/cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        padding: 40px 20px;
    }

    .hero-content {
        max-width: 700px;
    }

    .hero-content .subtitle {
        text-transform: uppercase;
        letter-spacing: 4px;
        font-size: 12px;
        margin-bottom: 20px;
    }

    .hero-content h2 {
        font-family: Georgia, serif;
        font-size: clamp(32px, 5vw, 52px);
        margin-bottom: 18px;
        line-height: 1.2;
    }

    .hero-content p {
        font-size: 16px;
        line-height: 1.7;
        margin-bottom: 28px;
    }

    .hero-button {
        display: inline-block;
        background: #dceffa;
        color: #193b50;
        text-decoration: none;
        padding: 14px 28px;
        font-weight: bold;
        border-radius: 4px;
        transition: 0.2s;
    }

    .hero-button:hover {
        background: white;
    }

    /* INTRODUCTION */

    .intro-section {
        text-align: center;
        padding: 65px 20px 35px;
    }

    .intro-section h2 {
        font-family: Georgia, serif;
        color: #193b50;
        font-size: 30px;
        margin-bottom: 15px;
    }

    .intro-section p {
        color: #777;
        line-height: 1.8;
        max-width: 650px;
        margin: auto;
    }

    /* CUSTOMER SERVICES */

    .customer-services {
        padding: 30px 0 65px;
    }

    .services-heading {
        text-align: center;
        color: #183b56;
        font-family: Georgia, serif;
        font-size: 29px;
        margin-bottom: 12px;
    }

    .services-subtitle {
        text-align: center;
        color: #777;
        font-size: 15px;
        margin-bottom: 35px;
    }

    .services-list {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    /* SERVICE CARDS */

    .service-card {
        min-height: 230px;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        align-items: center;
        padding: 35px 40px;
        background-size: cover;
        background-position: center;
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.14);
        transition: transform 0.25s ease;
    }

    .service-card:hover {
        transform: translateY(-4px);
    }

    /* MAKE A RESERVATION PHOTO */

    .reservation-card {
        background-image:
            linear-gradient(
                rgba(10, 30, 45, 0.55),
                rgba(10, 30, 45, 0.55)
            ),
            url("/images/make-a-reservation.jfif");
    }

    /* MY RESERVATIONS PHOTO */

    .my-reservations-card {
        background-image:
            linear-gradient(
                rgba(10, 30, 45, 0.55),
                rgba(10, 30, 45, 0.55)
            ),
            url("/images/my-reservation.jfif");
    }

    /* CARD CONTENT */

    .service-content {
        max-width: 700px;
        color: white;
    }

    .service-content h3 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .service-content p {
        font-size: 16px;
        line-height: 1.7;
        color: #f0f4f8;
        margin-bottom: 22px;
    }

    /* SERVICE BUTTONS */

    .service-button {
        display: inline-block;
        background: #ffffff;
        color: #183b56;
        text-decoration: none;
        padding: 13px 25px;
        border-radius: 30px;
        font-size: 15px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .service-button:hover {
        background: #d6ad72;
        color: #183b56;
    }

    /* RESPONSIVE DESIGN */

    @media (max-width: 650px) {

        .customer-hero {
            min-height: 350px;
            padding: 30px 18px;
        }

        .hero-content h2 {
            font-size: 34px;
        }

        .intro-section {
            padding: 45px 15px 25px;
        }

        .intro-section h2 {
            font-size: 26px;
        }

        .customer-services {
            padding: 25px 0 45px;
        }

        .service-card {
            min-height: 220px;
            padding: 25px;
        }

        .service-content h3 {
            font-size: 24px;
        }

        .service-content p {
            font-size: 14px;
        }

        .service-button {
            width: 100%;
            text-align: center;
        }
    }
</style>

<!-- HERO BANNER -->

<section class="customer-hero">

    <div class="hero-content">

        <p class="subtitle">Welcome to our hotel</p>

        <h2>Experience Comfort and Elegance</h2>

        <p>
            Discover a relaxing stay with comfortable rooms
            and thoughtful hospitality.
        </p>

        <a href="{{ route('rooms.available') }}" class="hero-button">
            EXPLORE OUR ROOMS
        </a>

    </div>

</section>

<!-- INTRODUCTION -->

<section class="intro-section">

    <h2>A Stay Worth Remembering</h2>

    <p>
        Whether you're traveling for relaxation or a special occasion,
        we offer a welcoming place to rest, recharge, and enjoy your stay.
    </p>

</section>

<!-- CUSTOMER SERVICES -->

<section class="customer-services">

    <h2 class="services-heading">Your Stay, Your Way</h2>

    <p class="services-subtitle">
        Manage your bookings and make the most of your stay with us.
    </p>

    <div class="services-list">

        <!-- MAKE A RESERVATION -->

        <div class="service-card reservation-card">

            <div class="service-content">

                <h3>Make a Reservation</h3>

                <p>
                    Find your preferred accommodation and book a room
                    for your upcoming stay.
                </p>

                <a
                    href="{{ url('/reservations/create') }}"
                    class="service-button"
                >
                    BOOK A ROOM →
                </a>

            </div>

        </div>

        <!-- MY RESERVATIONS -->

        <div class="service-card my-reservations-card">

            <div class="service-content">

                <h3>My Reservations</h3>

                <p>
                    Keep track of your bookings, review your reservation
                    details, and check their current status.
                </p>

                <a
                    href="{{ url('/my-reservations') }}"
                    class="service-button"
                >
                    VIEW MY RESERVATIONS →
                </a>

            </div>

        </div>

    </div>

</section>

@endsection
