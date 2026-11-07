
<!DOCTYPE html>
<html>
<head>
    <title>Available Rooms</title>
</head>
<body>

    <h1>Available Hotel Rooms</h1>

    @forelse ($rooms as $room)

        <div>
            <h3>Room {{ $room->room_number }}</h3>

            <p>Class: {{ $room->room_class }}</p>
            <p>Bed Type: {{ $room->bed_type }}</p>
            <p>Maximum Occupancy: {{ $room->max_occupancy }}</p>
            <p>View: {{ $room->view_type }}</p>

            <p>
                Price per Night:
                ₱{{ number_format($room->price_per_night, 2) }}
            </p>
        </div>

        <hr>

    @empty

        <p>No available rooms at the moment.</p>

    @endforelse

</body>
</html>
