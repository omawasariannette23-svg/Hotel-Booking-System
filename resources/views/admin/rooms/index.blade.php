
@extends('layouts.app')

@section('title', 'Room Management')

@section('content')

<style>
    .room-management {
        max-width: 1200px;
        margin: 20px auto;
    }

    .room-management h2 {
        margin-top: 25px;
        color: #183b56;
    }

    .add-room-btn {
        display: inline-block;
        background: #183b56;
        color: white;
        padding: 10px 18px;
        text-decoration: none;
        border-radius: 6px;
        margin-top: 15px;
    }

    .room-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        margin-top: 20px;
    }

    .room-table th,
    .room-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }

    .room-table th {
        background: #183b56;
        color: white;
    }

    .room-table tr:nth-child(even) {
        background: #f5f7fa;
    }

    .room-photo {
        width: 100px;
        height: 70px;
        object-fit: cover;
        border-radius: 6px;
    }

    .no-photo {
        color: #888;
        font-size: 13px;
    }

    .edit-btn {
        color: #183b56;
        margin-right: 8px;
    }

    .delete-btn {
        background: #b83232;
        color: white;
        border: none;
        padding: 7px 12px;
        border-radius: 4px;
        cursor: pointer;
    }

    .success-message {
        color: green;
        margin-top: 15px;
    }

    .error-message {
        color: red;
        margin-top: 15px;
    }
</style>

<div class="room-management">

    <h1>Room Management</h1>

    <a class="add-room-btn" href="{{ route('admin.rooms.create') }}">
        + Add New Room
    </a>

    @if (session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p class="error-message">{{ session('error') }}</p>
    @endif

    <h2>All Rooms</h2>

    @if ($rooms->isEmpty())

        <p>No rooms have been added yet.</p>

    @else

        <table class="room-table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Room Number</th>
                    <th>Room Class</th>
                    <th>Bed Type</th>
                    <th>Max Occupancy</th>
                    <th>Price per Night</th>
                    <th>View Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($rooms as $room)
                    <tr>

                        <td>
                            @if ($room->image)
                                <img
                                    src="{{ asset('storage/' . $room->image) }}"
                                    alt="Room {{ $room->room_number }}"
                                    class="room-photo"
                                >
                            @else
                                <span class="no-photo">No photo</span>
                            @endif
                        </td>

                        <td>{{ $room->room_number }}</td>
                        <td>{{ $room->room_class }}</td>
                        <td>{{ $room->bed_type }}</td>
                        <td>{{ $room->max_occupancy }}</td>
                        <td>₱{{ number_format($room->price_per_night, 2) }}</td>
                        <td>{{ $room->view_type }}</td>
                        <td>{{ ucfirst($room->status) }}</td>

                        <td>
                            <a class="edit-btn"
                               href="{{ route('admin.rooms.edit', $room->id) }}">
                                Edit
                            </a>

                            <form
                                action="{{ route('admin.rooms.destroy', $room->id) }}"
                                method="POST"
                                style="display:inline;"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this room?')"
                                >
                                    Delete
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif

</div>

@endsection
