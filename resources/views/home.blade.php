
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home | Hotel Booking System</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #ffffff;
            color: #243b53;
        }

        /* NAVIGATION */

        .navbar {
            background: #183b56;
            min-height: 78px;
            padding: 15px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .hotel-logo {
            color: white;
            font-family: Georgia, serif;
            font-size: 25px;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
        }

        .nav-links a:hover {
            color: #d6ad72;
        }

        .nav-links .register-link {
            background: #d6ad72;
            color: #183b56;
            padding: 11px 20px;
            border-radius: 4px;
            font-weight: bold;
        }

        .nav-links .register-link:hover {
            background: #ffffff;
        }

        /* HERO SECTION */

        .hero {
            min-height: 580px;
            background:
                linear-gradient(
                    rgba(15, 39, 57, 0.50),
                    rgba(15, 39, 57, 0.50)
                ),
                url("/images/hotel-hero.jpg") center/cover no-repeat;

            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 60px 25px;
            color: white;
        }

        .hero-content {
            max-width: 800px;
        }

        .hero-subtitle {
            text-transform: uppercase;
            letter-spacing: 5px;
            font-size: 13px;
            margin-bottom: 22px;
        }

        .hero h1 {
            font-family: Georgia, serif;
            font-size: clamp(38px, 6vw, 65px);
            line-height: 1.2;
            margin-bottom: 22px;
        }

        .hero-description {
            font-size: 17px;
            line-height: 1.8;
            max-width: 650px;
            margin: 0 auto 32px;
        }

        .hero-button {
            display: inline-block;
            background: #dceffa;
            color: #183b56;
            padding: 15px 30px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
            transition: 0.2s;
        }

        .hero-button:hover {
            background: #d6ad72;
        }

        /* INTRODUCTION */

        .about-section {
            padding: 85px 20px;
            text-align: center;
            max-width: 900px;
            margin: auto;
        }

        .section-subtitle {
            color: #b58b54;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .about-section h2 {
            font-family: Georgia, serif;
            font-size: 36px;
            color: #183b56;
            margin-bottom: 22px;
        }

        .about-section p {
            color: #6b7785;
            font-size: 16px;
            line-height: 1.9;
        }

        /* FOOTER */

        .footer {
            background: #183b56;
            color: white;
            text-align: center;
            padding: 25px 15px;
            font-size: 14px;
        }

        /* RESPONSIVE */

        @media (max-width: 750px) {

            .navbar {
                justify-content: center;
                text-align: center;
            }

            .nav-links {
                justify-content: center;
                gap: 16px;
            }

            .hero {
                min-height: 470px;
            }

            .hero h1 {
                font-size: 38px;
            }

            .hero-description {
                font-size: 15px;
            }

            .about-section {
                padding: 60px 22px;
            }

            .about-section h2 {
                font-size: 29px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVIGATION BAR -->

    <header class="navbar">

        <a href="{{ route('home') }}" class="hotel-logo">
            HOTEL BOOKING
        </a>

        <nav class="nav-links">

            <a href="{{ route('home') }}">Home</a>

            <a href="#about">About Us</a>

            <a href="{{ route('login') }}">Rooms</a>

            <a href="#contact">Contact Us</a>

            <a href="{{ route('login') }}">Login</a>

            <a href="{{ route('register') }}" class="register-link">
                Register
            </a>

        </nav>

    </header>

    <!-- HERO SECTION -->

    <section class="hero">

        <div class="hero-content">

            <p class="hero-subtitle">
                Welcome to our hotel
            </p>

            <h1>
                Experience Comfort and Elegance
            </h1>

            <p class="hero-description">
                Discover a relaxing stay with comfortable rooms
                and thoughtful hospitality. Your next memorable
                experience begins here.
            </p>

            <a href="{{ route('login') }}" class="hero-button">
                EXPLORE OUR ROOMS
            </a>

        </div>

    </section>

    <!-- ABOUT SECTION -->

    <section class="about-section" id="about">

        <p class="section-subtitle">
            Discover Our Hotel
        </p>

        <h2>A Stay Worth Remembering</h2>

        <p>
            Whether you're traveling for relaxation or a special occasion,
            we offer a welcoming place to rest, recharge, and enjoy your stay.
            Experience comfort, convenience, and thoughtful hospitality
            throughout your visit.
        </p>

    </section>

    <!-- CONTACT PLACEHOLDER -->

    <footer class="footer" id="contact">

        <p>
            &copy; {{ date('Y') }} Hotel Booking System.
            All Rights Reserved.
        </p>

    </footer>

</body>
</html>
