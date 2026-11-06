<!DOCTYPE html>
<html>
<head>
    <title>Add Room</title>
</head>
<body>

    <h1>Add New Room</h1>

    <form action="{{ route('admin.rooms.store') }}" method="POST">
        @csrf

        <label>Room Number:</label>
        <input type="text" name="room_number" required>
        <br><br>

        <label>Room Class:</label>
        <input type="text" name="room_class" required>
        <br><br>

        <label>Bed Type:</label>
        <input type="text" name="bed_type" required>
        <br><br>

        <label>Maximum Occupancy:</label>
        <input type="number" name="max_occupancy" min="1" required>
        <br><br>

        <label>Price per Night:</label>
        <input type="number" name="price_per_night" min="0" step="0.01" required>
        <br><br>

        <label>View Type:</label>
        <input type="text" name="view_type" required>
        <br><br>

        <button type="submit">Save Room</button>
    </form>

    <p><a href="{{ route('admin.rooms.index') }}">Back to Room List</a></p>

</body>
</html>