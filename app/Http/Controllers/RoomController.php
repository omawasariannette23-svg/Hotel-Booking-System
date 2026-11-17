<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    // Display all rooms for admin
    public function index()
    {
        $rooms = Room::all();

        return view('admin.rooms.index', compact('rooms'));
    }

    // Show the form for creating a room
    public function create()
    {
        return view('admin.rooms.create');
    }

    // Store a newly created room
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number' => ['required', 'string', 'max:20', 'unique:rooms,room_number'],
            'room_class' => ['required', 'string', 'max:100'],
            'bed_type' => ['required', 'string', 'max:100'],
            'max_occupancy' => ['required', 'integer', 'min:1'],
            'price_per_night' => ['required', 'numeric', 'min:0'],
            'view_type' => ['required', 'string', 'max:100'],
            'status' => ['required', 'in:available,unavailable,maintenance'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        // Upload room image if provided
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('rooms', 'public');
        }

        Room::create($validated);

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Room added successfully!');
    }

    // Display a specific room
    public function show(Room $room)
{
    return view('rooms.show', compact('room'));
}

    // Show the form for editing a room
    public function edit(string $id)
    {
        $room = Room::findOrFail($id);

        return view('admin.rooms.edit', compact('room'));
    }

    // Update an existing room
    public function update(Request $request, string $id)
    {
        $room = Room::findOrFail($id);

        $validated = $request->validate([
            'room_number' => ['required', 'string', 'max:20', 'unique:rooms,room_number,' . $id],
            'room_class' => ['required', 'string', 'max:100'],
            'bed_type' => ['required', 'string', 'max:100'],
            'max_occupancy' => ['required', 'integer', 'min:1'],
            'price_per_night' => ['required', 'numeric', 'min:0'],
            'view_type' => ['required', 'string', 'max:100'],
            'status' => ['required', 'in:available,unavailable,maintenance'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        // Replace the old image if a new one is uploaded
        if ($request->hasFile('image')) {

            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }

            $validated['image'] = $request->file('image')->store('rooms', 'public');
        }

        $room->update($validated);

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Room updated successfully!');
    }

    // Delete a room
    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);

        // Prevent deletion if the room has reservation records
        if ($room->reservations()->exists()) {
            return redirect()
                ->route('admin.rooms.index')
                ->with('error', 'This room cannot be deleted because it has reservation records.');
        }

        // Delete the room image
        if ($room->image) {
            Storage::disk('public')->delete($room->image);
        }

        $room->delete();

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Room deleted successfully!');
    }

    // Display available rooms and check reservation conflicts
    public function available(Request $request)
    {
        $validated = null;

        // Validate dates only when the customer starts searching
        if ($request->filled('check_in') || $request->filled('check_out')) {
            $validated = $request->validate([
                'check_in' => ['required', 'date', 'after_or_equal:today'],
                'check_out' => ['required', 'date', 'after:check_in'],
            ]);
        }

        // Retrieve all operational rooms
        $roomQuery = Room::where('status', 'available');

        // Check reservation conflicts if dates were provided
        if ($validated) {
            $roomQuery->withExists([
                'reservations as has_conflict' => function ($query) use ($validated) {
                    $query->whereIn('booking_status', [
                        'pending',
                        'confirmed',
                        'checked_in'
                    ])
                    ->where('check_in', '<', $validated['check_out'])
                    ->where('check_out', '>', $validated['check_in']);
                }
            ]);
        }

        $rooms = $roomQuery->get();

        return view('rooms.available', compact('rooms', 'validated'));
    }
}
