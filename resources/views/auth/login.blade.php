<!DOCTYPE html>
<html>
<head>
    <title>Hotel Booking System - Login</title>
</head>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<body>

    <h1>Hotel Booking System</h1>
    <h2>Login</h2>

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <label>Email:</label>
        <input type="email" name="email" required>

        <br><br>

        <label>Password:</label>
        <input type="password" name="password" required>

        <br><br>

        <button type="submit">Login</button>
    </form>

    @if ($errors->any())
        <p>{{ $errors->first() }}</p>
    @endif

    <p>Don't have an account?
    <a href="{{ route('register') }}">Register here</a>
</p>

</body>
</html>