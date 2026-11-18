<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | L'Arikabel Hotel</title>

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
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            min-height: 100vh;
            color: #243b53;
        }

        /* HEADER */

        .page-header {
            background: #183b56;
            padding: 18px 6%;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .hotel-logo {
            color: white;
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: 36px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-decoration: none;
        }

        .header-subtitle {
            color: #d6ad72;
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 3px;
        }

        /* MAIN CONTENT */

        .main-content {
            min-height: calc(100vh - 100px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 45px 15px;
        }

        .register-container {
            width: 100%;
            max-width: 480px;
        }

        .register-card {
            background: white;
            padding: 38px 40px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(24, 59, 86, 0.10);
            border: 1px solid #d9e2ec;
        }

        .form-title {
            color: #183b56;
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .form-description {
            color: #627d98;
            font-size: 14px;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        /* FORM FIELDS */

        .form-group {
            margin-bottom: 17px;
        }

        .form-group label {
            display: block;
            color: #334e68;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #bcccdc;
            border-radius: 7px;
            outline: none;
            font-size: 14px;
            color: #243b53;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #183b56;
            box-shadow: 0 0 0 3px rgba(24, 59, 86, 0.10);
        }

        .form-group input::placeholder {
            color: #9fb3c8;
        }

        /* PASSWORD SHOW/HIDE */

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 55px;
        }

        .toggle-password {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #627d98;
            font-size: 13px;
            font-weight: 600;
        }

        .toggle-password:hover {
            color: #183b56;
        }

        /* VALIDATION ERRORS */

        .error-box {
            background: #fff1f0;
            border: 1px solid #f5c6cb;
            color: #9b2c2c;
            padding: 12px 15px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .error-box ul {
            padding-left: 18px;
        }

        /* REGISTER BUTTON */

        .register-button {
            width: 100%;
            padding: 13px;
            background: #183b56;
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 8px;
            transition: 0.2s;
        }

        .register-button:hover {
            background: #254f70;
        }

        /* LOGIN LINK */

        .login-link {
            text-align: center;
            margin-top: 23px;
            color: #627d98;
            font-size: 14px;
        }

        .login-link a {
            color: #183b56;
            font-weight: 700;
            text-decoration: none;
        }

        .login-link a:hover {
            color: #b58b54;
            text-decoration: underline;
        }

        /* FOOTER */

        .footer-text {
            text-align: center;
            color: #829ab1;
            font-size: 12px;
            margin-top: 20px;
        }

        /* RESPONSIVE */

        @media (max-width: 500px) {
            .register-card {
                padding: 30px 22px;
            }

            .hotel-logo {
                font-size: 30px;
            }

            .form-title {
                font-size: 29px;
            }

            .main-content {
                padding: 30px 15px;
            }
        }
    </style>
</head>

<body>

    <!-- HOTEL HEADER -->

    <header class="page-header">

        <a href="{{ route('home') }}" class="hotel-logo">
            L'Arikabel Hotel
        </a>

        <p class="header-subtitle">
            Comfort • Elegance • Hospitality
        </p>

    </header>

    <!-- MAIN CONTENT -->

    <main class="main-content">

        <div class="register-container">

            <div class="register-card">

                <h2 class="form-title">
                    Create an Account
                </h2>

                <p class="form-description">
                    Register to start booking your stay with us.
                </p>

                {{-- VALIDATION ERRORS --}}

                @if ($errors->any())
                    <div class="error-box">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- REGISTRATION FORM --}}

                <form action="{{ route('register.submit') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            value="{{ old('first_name') }}"
                            placeholder="Enter your first name"
                            autocomplete="given-name"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input
                            type="text"
                            id="last_name"
                            name="last_name"
                            value="{{ old('last_name') }}"
                            placeholder="Enter your last name"
                            autocomplete="family-name"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email address"
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
                                placeholder="Create a password"
                                autocomplete="new-password"
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

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>

                        <div class="password-wrapper">
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Confirm your password"
                                autocomplete="new-password"
                                required
                            >

                            <button
                                type="button"
                                class="toggle-password"
                                onclick="togglePassword('password_confirmation', this)"
                            >
                                Show
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="register-button">
                        Create Account
                    </button>

                </form>

                <div class="login-link">
                    Already have an account?
                    <a href="{{ route('login') }}">Login here</a>
                </div>

            </div>

            <p class="footer-text">
                &copy; {{ date('Y') }} L'Arikabel Hotel. All Rights Reserved.
            </p>

        </div>

    </main>

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
