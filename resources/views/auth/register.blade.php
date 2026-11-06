<!DOCTYPE html>
<html>
<head>
    <title>Customer Registration</title>
</head>
<body>

    <h1>Create an Account</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('register.submit') }}" method="POST">
        @csrf

        <label>First Name:</label>
        <input type="text" name="first_name" required>
        <br><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" required>
        <br><br>

        <label>Email:</label>
        <input type="email" name="email" required>
        <br><br>

        <label>Password:</label>
        <input type="password" name="password" required>
        <br><br>

        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation" required>
        <br><br>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>

</body>
</html>