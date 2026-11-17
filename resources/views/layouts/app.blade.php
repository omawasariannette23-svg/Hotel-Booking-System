
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Hotel Booking System')</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        /* HEADER */

        header {
            background-color: #183b56;
            color: white;
            padding: 22px 40px;
        }

        .header-content {
            max-width: 1500px;
            margin: auto;
        }

        header h1 {
            font-size: 26px;
            letter-spacing: 0.3px;
        }

        /* NAVIGATION */

        nav {
            background-color: #ffffff;
            padding: 17px 40px;
            border-bottom: 1px solid #d9e2ec;
        }

        .nav-content {
            width: 100%;
            max-width: 1500px;
            margin: auto;
            display: flex;
            align-items: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        nav a {
            text-decoration: none;
            color: #183b56;
            font-weight: 600;
            font-size: 14px;
            transition: 0.2s ease;
        }

        nav a:hover {
            color: #d18b47;
        }

        /* MY ACCOUNT BUTTON */

        .account-menu {
            position: relative;
            margin-left: auto;
        }

        .account-button {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 16px;
            background-color: white;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            color: #183b56;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            list-style: none;
            transition: 0.2s ease;
        }

        .account-button::-webkit-details-marker {
            display: none;
        }

        .account-button:hover {
            background-color: #f0f5f9;
            border-color: #183b56;
        }

        .account-icon {
            width: 19px;
            height: 19px;
        }

        .dropdown-arrow {
            font-size: 11px;
            margin-left: 3px;
        }

        /* ACCOUNT DROPDOWN */

        .account-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 250px;
            background-color: white;
            border: 1px solid #d9e2ec;
            border-radius: 9px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.12);
            padding: 17px;
            z-index: 1000;
        }

        .account-info {
            padding-bottom: 14px;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 13px;
        }

        .account-name {
            color: #183b56;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .account-email {
            color: #64748b;
            font-size: 12px;
            overflow-wrap: anywhere;
            margin-bottom: 7px;
        }

        .account-role {
            display: inline-block;
            background-color: #eaf2f8;
            color: #183b56;
            padding: 4px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: capitalize;
        }

        /* LOGOUT */

        .logout-form {
            width: 100%;
        }

        .logout-button {
            width: 100%;
            background-color: white;
            color: #b84040;
            border: 1px solid #e5aaaa;
            padding: 10px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .logout-button:hover {
            background-color: #fff1f0;
        }

        /* MAIN CONTENT */

        main {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 25px;
            min-height: 65vh;
        }

        main.wide-main {
            max-width: 1600px;
        }

        .page-container {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        /* FOOTER */

        footer {
            background-color: #183b56;
            color: #d9e2ec;
            text-align: center;
            padding: 22px;
            font-size: 13px;
        }

        /* RESPONSIVE DESIGN */

        @media (max-width: 700px) {
            header {
                padding: 20px;
            }

            nav {
                padding: 15px 20px;
            }

            .nav-content {
                gap: 18px;
            }

            .account-menu {
                margin-left: 0;
            }

            main {
                padding: 0 15px;
            }

            .page-container {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="header-content">
            <h1>Hotel Booking System</h1>
        </div>
    </header>

    <nav>
        <div class="nav-content">

            <a href="{{ auth()->check() ? route(auth()->user()->role . '.dashboard') : route('home') }}">
                Home
            </a>

            <a href="{{ url('/about') }}">About Us</a>

            <a href="{{ url('/gallery') }}">Gallery</a>

            <a href="{{ url('/rooms') }}">Rooms</a>

            <a href="{{ url('/contact') }}">Contact Us</a>

            <a href="{{ url('/blog') }}">Blog</a>

            @auth
                <details class="account-menu">

                    <summary class="account-button">

                        <svg class="account-icon"
                             xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="1.8">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M15 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM4.5 20a7.5 7.5 0 0 1 15 0"/>
                        </svg>

                        My Account

                        <span class="dropdown-arrow">▼</span>

                    </summary>

                    <div class="account-dropdown">

                        <div class="account-info">

                            <p class="account-name">
                                {{ auth()->user()->first_name }}
                                {{ auth()->user()->last_name }}
                            </p>

                            <p class="account-email">
                                {{ auth()->user()->email }}
                            </p>

                            <span class="account-role">
                                {{ auth()->user()->role }}
                            </span>

                        </div>

                        <form action="{{ route('logout') }}"
                              method="POST"
                              class="logout-form">

                            @csrf

                            <button type="submit" class="logout-button">
                                Logout
                            </button>

                        </form>

                    </div>

                </details>
            @endauth

        </div>
    </nav>

    <main class="@yield('main-class')">
        <div class="page-container">
            @yield('content')
        </div>
    </main>

    <footer>
        &copy; {{ date('Y') }} Hotel Booking System. All rights reserved.
    </footer>

</body>
</html>
