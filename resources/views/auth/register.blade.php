
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Customer Registration | Hotel Booking System</title>

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
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 15px;
            color: #243b53;
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

        .brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand h1 {
            color: #183b56;
            font-size: 27px;
            margin-bottom: 8px;
        }

        .brand p {
            color: #829ab1;
            font-size: 14px;
        }

        .form-title {
            color: #183b56;
            font-size: 23px;
            margin-bottom: 7px;
        }

        .form-description {
            color: #627d98;
            font-size: 14px;
            margin-bottom: 25px;
        }

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
            text-decoration: underline;
        }

        .footer-text {
            text-align: center;
            color: #829ab1;
            font-size: 12px;
            margin-top: 20px;
        }

        @media (max-width: 500px) {
            .register-card {
                padding: 30px 22px;
            }

            .brand h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

    <div class="register-container">

        <div class="register-card">

            <div class="brand">
                <h1>HOTEL BOOKING SYSTEM</h1>
                <p>Your comfort begins with us.</p>
            </div>

            <h2 class="form-title">Create an Account</h2>

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
            Hotel Booking System &copy; {{ date('Y') }}
        </p>

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
