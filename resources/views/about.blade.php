```blade
@extends('layouts.app')

@section('title', "About Us | L'Arikabel Hotel")

@section('content')

<style>
    .about-page {
        color: #263746;
        background: #f8f7f3;
    }

    .about-hero {
        background: linear-gradient(
            rgba(15, 43, 63, 0.88),
            rgba(15, 43, 63, 0.88)
        ),
        url('/images/hotel-hero.jpg');

        background-size: cover;
        background-position: center;
        text-align: center;
        padding: 100px 20px;
        color: white;
    }

    .about-hero h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 52px;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .about-hero p {
        font-size: 16px;
        letter-spacing: 2px;
        color: #e2c69e;
    }

    .about-container {
        max-width: 1100px;
        margin: auto;
        padding: 70px 25px;
    }

    .section-label {
        color: #b58b54;
        text-transform: uppercase;
        letter-spacing: 3px;
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 12px;
    }

    .section-title {
        color: #183b56;
        font-family: 'Cormorant Garamond', serif;
        font-size: 38px;
        margin-bottom: 20px;
    }

    .story-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: center;
    }

    .story-section img {
        width: 100%;
        height: 350px;
        object-fit: cover;
        border-radius: 8px;
    }

    .story-text p {
        line-height: 1.9;
        color: #66717a;
        margin-bottom: 15px;
    }

    .mission-vision {
        background: #183b56;
        color: white;
    }

    .mission-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .mission-card {
        padding: 35px;
        border: 1px solid rgba(214, 173, 114, 0.5);
        border-radius: 8px;
    }

    .mission-card h3 {
        color: #e2c69e;
        font-family: 'Cormorant Garamond', serif;
        font-size: 30px;
        margin-bottom: 15px;
    }

    .mission-card p {
        color: #e3e8ec;
        line-height: 1.8;
    }

    .values-section {
        text-align: center;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
        margin-top: 35px;
    }

    .value-card {
        background: white;
        padding: 30px 22px;
        border-radius: 8px;
        border-bottom: 3px solid #d6ad72;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .value-card h3 {
        color: #183b56;
        font-family: 'Cormorant Garamond', serif;
        font-size: 25px;
        margin-bottom: 10px;
    }

    .value-card p {
        color: #66717a;
        line-height: 1.7;
        font-size: 14px;
    }

    .about-cta {
        background: #eae5dc;
        text-align: center;
        padding: 65px 20px;
    }

    .about-cta h2 {
        color: #183b56;
        font-family: 'Cormorant Garamond', serif;
        font-size: 36px;
        margin-bottom: 15px;
    }

    .about-cta p {
        color: #66717a;
        margin-bottom: 25px;
    }

    .about-button {
        display: inline-block;
        background: #183b56;
        color: white;
        text-decoration: none;
        padding: 13px 30px;
        border-radius: 4px;
        transition: 0.3s;
    }

    .about-button:hover {
        background: #b58b54;
        color: white;
    }

    @media (max-width: 768px) {
        .story-section,
        .mission-grid {
            grid-template-columns: 1fr;
        }

        .values-grid {
            grid-template-columns: 1fr;
        }

        .about-hero h1 {
            font-size: 40px;
        }

        .section-title {
            font-size: 32px;
        }
    }
</style>

<div class="about-page">

    <!-- HERO SECTION -->
    <section class="about-hero">
        <h1>About L'Arikabel Hotel</h1>
        <p>COMFORT • ELEGANCE • HOSPITALITY</p>
    </section>

    <!-- OUR STORY -->
    <section class="about-container">
        <div class="story-section">

            <div class="story-text">
                <div class="section-label">Discover Our Story</div>

                <h2 class="section-title">
                    A Place Where Comfort Meets Elegance
                </h2>

                <p>
                    L'Arikabel Hotel was envisioned as a welcoming retreat
                    for travelers seeking comfort, relaxation, and a
                    memorable accommodation experience.
                </p>

                <p>
                    Inspired by timeless elegance and genuine hospitality,
                    our hotel brings together thoughtfully designed spaces
                    and convenient services to make every guest feel at home.
                </p>

                <p>
                    We believe that every stay should be more than just
                    a place to rest. It should be an experience built
                    around comfort, convenience, and thoughtful service.
                </p>
            </div>

            <div>
                <img src="{{ asset('images/hotel-hero.jpg') }}"
                     alt="L'Arikabel Hotel">
            </div>

        </div>
    </section>

    <!-- MISSION AND VISION -->
    <section class="mission-vision">
        <div class="about-container">

            <div class="mission-grid">

                <div class="mission-card">
                    <h3>Our Mission</h3>

                    <p>
                        To provide guests with comfortable accommodations,
                        convenient booking experiences, and attentive
                        hospitality while creating a welcoming environment
                        for every stay.
                    </p>
                </div>

                <div class="mission-card">
                    <h3>Our Vision</h3>

                    <p>
                        To become a trusted hospitality destination known
                        for its elegance, quality service, and commitment
                        to making every guest's stay meaningful and memorable.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- OUR VALUES -->
    <section class="about-container values-section">

        <div class="section-label">What Guides Us</div>

        <h2 class="section-title">Our Core Values</h2>

        <p>
            The principles that shape our commitment to every guest.
        </p>

        <div class="values-grid">

            <div class="value-card">
                <h3>Comfort</h3>
                <p>
                    Creating a welcoming environment where guests
                    can relax and feel at ease.
                </p>
            </div>

            <div class="value-card">
                <h3>Hospitality</h3>
                <p>
                    Treating every guest with warmth, respect,
                    and thoughtful service.
                </p>
            </div>

            <div class="value-card">
                <h3>Excellence</h3>
                <p>
                    Striving to provide a pleasant and dependable
                    accommodation experience.
                </p>
            </div>

            <div class="value-card">
                <h3>Integrity</h3>
                <p>
                    Building trust through honesty, responsibility,
                    and transparency.
                </p>
            </div>

            <div class="value-card">
                <h3>Convenience</h3>
                <p>
                    Making room browsing and reservation management
                    simple and accessible.
                </p>
            </div>

            <div class="value-card">
                <h3>Dedication</h3>
                <p>
                    Continuously working toward better guest
                    experiences and service.
                </p>
            </div>

        </div>

    </section>

    <!-- CALL TO ACTION -->
    <section class="about-cta">

        <h2>Your Stay Begins Here</h2>

        <p>
            Discover a comfortable and welcoming place for your next stay.
        </p>

        @auth
            <a href="{{ route('rooms.available') }}" class="about-button">
                Explore Our Rooms
            </a>
        @else
            <a href="{{ route('login') }}" class="about-button">
                Explore Our Rooms
            </a>
        @endauth

    </section>

</div>

@endsection
```