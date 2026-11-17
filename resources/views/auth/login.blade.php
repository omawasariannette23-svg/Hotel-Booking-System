
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hotel Booking System - Login</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: Georgia, serif;
            background: #f4f7fa;
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
                    rgba(12, 35, 53, 0.75),
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
            font-size: 43px;
            font-weight: normal;
            margin-bottom: 15px;
        }

        .hotel-text p {
            font-size: 18px;
            line-height: 1.7;
            color: #e5edf4;
        }

        /* LOGIN FORM SECTION */

        .form-section {
            flex: 0.9;
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 45px;
            background: #f4f7fa;
        }

        .login-box {
            width: 100%;
            max-width: 420px;
        }

        .hotel-icon {
            text-align: center;
            font-size: 42px;
            color: #183b56;
            margin-bottom: 15px;
        }

        .login-box h2 {
            text-align: center;
            font-size: 34px;
            color: #183b56;
            font-weight: normal;
            margin-bottom: 12px;
        }

        .subtitle {
            text-align: center;
            color: #718394;
            margin-bottom: 35px;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 9px;
            color: #29465d;
            font-size: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 1px solid #cbd8e2;
            border-radius: 8px;
            background: #ffffff;
            font-size: 15px;
            outline: none;
            transition: 0.2s;
            font-family: Georgia, serif;
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
            font-family: Georgia, serif;
            font-size: 13px;
            font-weight: bold;
        }

        .toggle-password:hover {
            color: #183b56;
        }

        .login-button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            background: #183b56;
            color: white;
            font-size: 17px;
            font-family: Georgia, serif;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 5px;
        }

        .login-button:hover {
            background: #102c42;
        }

        .register-text {
            text-align: center;
            margin-top: 28px;
            color: #718394;
            font-size: 15px;
        }

        .register-text a {
            color: #183b56;
            font-weight: bold;
            text-decoration: none;
        }

        .register-text a:hover {
            text-decoration: underline;
        }

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

        /* MOBILE RESPONSIVENESS */

        @media (max-width: 800px) {
            .hotel-section {
                display: none;
            }

            .form-section {
                flex: 1;
                padding: 30px 22px;
            }

            .login-box h2 {
                font-size: 30px;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="hotel-section">
        <div class="hotel-text">
            <h1>Welcome to Your Stay</h1>

            <p>
                Comfort, relaxation, and memorable experiences
                begin with the perfect reservation.
            </p>
        </div>
    </div>

    <div class="form-section">

        <div class="login-box">

            <div class="hotel-icon">✦</div>

            <h2>Hotel Booking System</h2>

            <p class="subtitle">
                Welcome back! Please log in to continue.
            </p>

            @if (session('success'))
                <div class="message success-message">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="message error-message">
                    {{ $errors->first() }}
                </div>
            @endif

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
