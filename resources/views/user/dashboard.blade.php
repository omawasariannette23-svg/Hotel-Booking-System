<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
</head>
<body>

    <h1>Welcome to the Customer Dashboard!</h1>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>
</html>