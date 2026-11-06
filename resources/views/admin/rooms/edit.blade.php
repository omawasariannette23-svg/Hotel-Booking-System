<!DOCTYPE html>
<html>
<head>
    <title>Edit Room</title>
</head>
<body>

    <h1>Edit Room</h1>

   <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Room Number:</label>
        <input type="text" name="room_number"
               value="{{ $room->room_number }}" required>
        <br><br>

        <label>Room Class:</label>
        <input type="text" name="room_class"
               value="{{ $room->room_class }}" required>
        <br><br>

        <label>Bed Type:</label>
        <input type="text" name="bed_type"
               value="{{ $room->bed_type }}" required>
        <br><br>

        <label>Maximum Occupancy:</label>
        <input type="number" name="max_occupancy"
               value="{{ $room->max_occupancy }}" min="1" required>
        <br><br>

        <label>Price per Night:</label>
        <input type="number" name="price_per_night"
               value="{{ $room->price_per_night }}" min="0" step="0.01" required>
        <br><br>

        <label>View Type:</label>
        <input type="text" name="view_type"
               value="{{ $room->view_type }}" required>
        <br><br>

        <label>Status:</label>
        <select name="status" required>
            <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
            <option value="unavailable" {{ $room->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
            <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
        </select>
        <br><br>

        <button type="submit">Update Room</button>
    </form>

    <p><a href="{{ route('admin.rooms.index') }}">Back to Room List</a></p>

</body>
</html>