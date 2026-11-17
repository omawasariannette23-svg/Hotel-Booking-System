
@extends('layouts.app')

@section('title', 'Edit Room')

@section('content')

<style>
    .edit-room-container {
        max-width: 650px;
        margin: 10px auto;
        padding: 35px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
    }

    .edit-room-container h2 {
        color: #183b56;
        margin-bottom: 25px;
    }

    .edit-room-container h3 {
        color: #183b56;
        margin-bottom: 15px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 7px;
        color: #263b50;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 11px;
        border: 1px solid #cbd8e3;
        border-radius: 6px;
        font-size: 14px;
        background: white;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #4b91c8;
        box-shadow: 0 0 4px rgba(75, 145, 200, 0.3);
    }

    .form-group input[type="file"] {
        background: #f5f9fc;
        cursor: pointer;
    }

    .photo-section {
        background: #f5f9fc;
        border: 1px solid #dce8f1;
        border-radius: 8px;
        padding: 20px;
        margin: 25px 0;
    }

    .current-photo {
        margin: 15px 0;
    }

    .current-photo img {
        width: 100%;
        max-width: 350px;
        height: 220px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #dce6ee;
    }

    .help-text {
        color: #718096;
        font-size: 13px;
        margin-top: 7px;
        line-height: 1.5;
    }

    .error-box {
        background: #fff0f0;
        color: #b42318;
        border: 1px solid #f2b8b5;
        border-radius: 6px;
        padding: 12px 18px;
        margin-bottom: 20px;
    }

    .update-button {
        background: #183b56;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 13px 22px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        width: 100%;
    }

    .update-button:hover {
        background: #245675;
    }

    .back-link {
        display: inline-block;
        margin-top: 20px;
        color: #397ca9;
        text-decoration: none;
        font-weight: bold;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    .edit-room-container hr {
        border: none;
        border-top: 1px solid #e2eaf0;
        margin: 25px 0;
    }
</style>

<div class="edit-room-container">

    <h2>Edit Room {{ $room->room_number }}</h2>

    @if ($errors->any())
        <div class="error-box">
            <strong>Please fix the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.rooms.update', $room->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Room Number:</label>
            <input type="text" name="room_number"
                   value="{{ old('room_number', $room->room_number) }}" required>
        </div>

        <div class="form-group">
            <label>Room Class:</label>
            <input type="text" name="room_class"
                   value="{{ old('room_class', $room->room_class) }}" required>
        </div>

        <div class="form-group">
            <label>Bed Type:</label>
            <input type="text" name="bed_type"
                   value="{{ old('bed_type', $room->bed_type) }}" required>
        </div>

        <div class="form-group">
            <label>Maximum Occupancy:</label>
            <input type="number" name="max_occupancy"
                   value="{{ old('max_occupancy', $room->max_occupancy) }}"
                   min="1" required>
        </div>

        <div class="form-group">
            <label>Price per Night:</label>
            <input type="number" name="price_per_night"
                   value="{{ old('price_per_night', $room->price_per_night) }}"
                   min="0" step="0.01" required>
        </div>

        <div class="form-group">
            <label>View Type:</label>
            <input type="text" name="view_type"
                   value="{{ old('view_type', $room->view_type) }}" required>
        </div>

        <div class="form-group">
            <label>Status:</label>
            <select name="status" required>
                <option value="available"
                    {{ old('status', $room->status) == 'available' ? 'selected' : '' }}>
                    Available
                </option>

                <option value="unavailable"
                    {{ old('status', $room->status) == 'unavailable' ? 'selected' : '' }}>
                    Unavailable
                </option>

                <option value="maintenance"
                    {{ old('status', $room->status) == 'maintenance' ? 'selected' : '' }}>
                    Maintenance
                </option>
            </select>
        </div>

        <hr>

        <div class="photo-section">

            <h3>Room Photo</h3>

            @if ($room->image)
                <div class="current-photo">
                    <p><strong>Current Photo:</strong></p>

                    <img src="{{ asset('storage/' . $room->image) }}"
                         alt="Room {{ $room->room_number }}">
                </div>
            @else
                <p>No photo uploaded for this room yet.</p>
            @endif

            <div class="form-group">
                <label for="image">Upload a New Photo:</label>

                <input type="file"
                       name="image"
                       id="image"
                       accept="image/jpeg,image/png,image/webp">

                <p class="help-text">
                    Leave this empty to keep the current photo.
                    Accepted formats: JPG, JPEG, PNG, WEBP.
                    Maximum size: 2 MB.
                </p>

                @error('image')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <button type="submit" class="update-button">
            Update Room
        </button>

    </form>

    <a href="{{ route('admin.rooms.index') }}" class="back-link">
        &larr; Back to Room List
    </a>

</div>

@endsection
