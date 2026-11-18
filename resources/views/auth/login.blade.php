<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | L'Arikabel Hotel</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: #f4f7fa;
            color: #243b53;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* HOTEL PHOTO SECTION */

        .hotel-section {
            flex: 1.1;
            min-height: 100vh;

            background:
                linear-gradient(
                    to top,
                    rgba(12, 35, 53, 0.78),
                    rgba(12, 35, 53, 0.05)
                ),
                url("{{ asset('images/login-cover.jfif') }}");

            background-size: cover;
            background-position: center;

            display: flex;
            align-items: flex-end;
            padding: 65px;
            color: white;
        }

        .hotel-text h1 {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: 58px;
            font-weight: 500;
            margin-bottom: 15px;
            line-height: 1.1;
        }

        .hotel-text p {
            font-size: 17px;
            line-height: 1.8;
            color: #e5edf4;
            max-width: 450px;
        }

        /* LOGIN FORM SECTION */

        .form-section {
            flex: 0.9;
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 35px 45px;
            background: #f4f7fa;
        }

        .login-box {
            width: 100%;
            max-width: 420px;
        }

        /* HOTEL HEADER */

        .hotel-header {
            text-align: center;
            margin-bottom: 38px;
        }

        .hotel-logo {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: 38px;
            font-weight: 600;
            letter-spacing: 1px;
            color: #183b56;
            text-decoration: none;
        }

        .hotel-tagline {
            color: #b58b54;
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 3px;
        }

        .hotel-icon {
            text-align: center;
            font-size: 35px;
            color: #b58b54;
            margin-bottom: 12px;
        }

        .login-box h2 {
            text-align: center;
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: 36px;
            color: #183b56;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            color: #718394;
            margin-bottom: 35px;
            font-size: 14px;
        }

        /* FORM FIELDS */

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 9px;
            color: #29465d;
            font-size: 14px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 1px solid #cbd8e2;
            border-radius: 8px;
            background: #ffffff;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
            font-family: Arial, sans-serif;
        }

        .form-group input:focus {
            border-color: #183b56;
            box-shadow: 0 0 0 3px rgba(24, 59, 86, 0.12);
        }

        /* PASSWORD SHOW/HIDE */

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 65px;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #627d98;
            font-family: Arial, sans-serif;
            font-size: 13px;
            font-weight: bold;
        }

        .toggle-password:hover {
            color: #183b56;
        }

        /* LOGIN BUTTON */

        .login-button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            background: #183b56;
            color: white;
            font-size: 15px;
            font-family: Arial, sans-serif;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 5px;
        }

        .login-button:hover {
            background: #102c42;
        }

        /* REGISTER LINK */

        .register-text {
            text-align: center;
            margin-top: 28px;
            color: #718394;
            font-size: 14px;
        }

        .register-text a {
            color: #183b56;
            font-weight: bold;
            text-decoration: none;
        }

        .register-text a:hover {
            color: #b58b54;
            text-decoration: underline;
        }

        /* MESSAGES */

        .message {
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .success-message {
            background: #e5f2e9;
            color: #356b45;
        }

        .error-message {
            background: #f9e8e8;
            color: #a33d35;
        }

        /* BACK TO HOMEPAGE */

        .home-link {
            display: block;
            text-align: center;
            margin-top: 22px;
            color: #829ab1;
            font-size: 13px;
            text-decoration: none;
        }

        .home-link:hover {
            color: #183b56;
        }

        /* MOBILE RESPONSIVENESS */

        @media (max-width: 800px) {

            .hotel-section {
                display: none;
            }

            .form-section {
                flex: 1;
                padding: 35px 22px;
            }

            .login-box h2 {
                font-size: 32px;
            }

            .hotel-logo {
                font-size: 34px;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <!-- HOTEL PHOTO SECTION -->

    <div class="hotel-section">

        <div class="hotel-text">

            <h1>Welcome to Your Stay</h1>

            <p>
                At L'Arikabel Hotel, comfort, relaxation, and
                memorable experiences begin with the perfect reservation.
            </p>

        </div>

    </div>

    <!-- LOGIN FORM SECTION -->

    <div class="form-section">

        <div class="login-box">

            <!-- HOTEL HEADER -->

            <div class="hotel-header">

                <a href="{{ route('home') }}" class="hotel-logo">
                    L'Arikabel Hotel
                </a>

                <p class="hotel-tagline">
                    Comfort • Elegance • Hospitality
                </p>

            </div>

            <div class="hotel-icon">✦</div>

            <h2>Welcome Back</h2>

            <p class="subtitle">
                Please log in to access your account.
            </p>

            {{-- SUCCESS MESSAGE --}}

            @if (session('success'))
                <div class="message success-message">
                    {{ session('success') }}
                </div>
            @endif

            {{-- VALIDATION ERRORS --}}

            @if ($errors->any())
                <div class="message error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- LOGIN FORM --}}

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        autocomplete="email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="toggle-password"
                            onclick="togglePassword('password', this)"
                        >
                            Show
                        </button>

                    </div>
                </div>

                <button type="submit" class="login-button">
                    Login
                </button>

            </form>

            <p class="register-text">
                Don't have an account?
                <a href="{{ route('register') }}">Register here</a>
            </p>

            <a href="{{ route('home') }}" class="home-link">
                ← Back to Homepage
            </a>

        </div>

    </div>

</div>

<script>
    function togglePassword(inputId, button) {
        const passwordInput = document.getElementById(inputId);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            button.textContent = 'Hide';
        } else {
            passwordInput.type = 'password';
            button.textContent = 'Show';
        }
    }
</script>

</body>
</html>
