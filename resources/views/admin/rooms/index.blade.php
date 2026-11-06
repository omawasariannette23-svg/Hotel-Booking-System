
<!DOCTYPE html>
<html>
<head>
    <title>Room Management</title>
</head>
<body>

    <h1>Room Management</h1>

    <a href="{{ route('admin.rooms.create') }}">Add New Room</a>

    <h2>All Rooms</h2>

    @if ($rooms->isEmpty())
        <p>No rooms have been added yet.</p>
    @else
        <table border="1" cellpadding="10">
            <tr>
                <th>Room Number</th>
                <th>Room Class</th>
                <th>Bed Type</th>
                <th>Max Occupancy</th>
                <th>Price per Night</th>
                <th>View Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->room_number }}</td>
                    <td>{{ $room->room_class }}</td>
                    <td>{{ $room->bed_type }}</td>
                    <td>{{ $room->max_occupancy }}</td>
                    <td>{{ $room->price_per_night }}</td>
                    <td>{{ $room->view_type }}</td>
                    <td>{{ $room->status }}</td>

                    <td>
                        <a href="{{ route('admin.rooms.edit', $room->id) }}">Edit</a>

                        <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this room?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

</body>
</html>
