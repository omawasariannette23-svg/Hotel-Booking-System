<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $rooms = Room::all();

    return view('admin.rooms.index', compact('rooms'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('admin.rooms.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'room_number' => ['required', 'string', 'unique:rooms,room_number'],
        'room_class' => ['required', 'string'],
        'bed_type' => ['required', 'string'],
        'max_occupancy' => ['required', 'integer', 'min:1'],
        'price_per_night' => ['required', 'numeric', 'min:0'],
        'view_type' => ['required', 'string'],
    ]);

    Room::create($validated);

    return redirect()->route('admin.rooms.index');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $id)
{
    $room = Room::findOrFail($id);

    return view('admin.rooms.edit', compact('room'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $room = Room::findOrFail($id);

    $validated = $request->validate([
        'room_number' => ['required', 'string', 'unique:rooms,room_number,' . $id],
        'room_class' => ['required', 'string'],
        'bed_type' => ['required', 'string'],
        'max_occupancy' => ['required', 'integer', 'min:1'],
        'price_per_night' => ['required', 'numeric', 'min:0'],
        'view_type' => ['required', 'string'],
        'status' => ['required', 'in:available,unavailable,maintenance'],
    ]);

    $room->update($validated);

    return redirect()->route('admin.rooms.index');
}

    /**
     * Remove the specified resource from storage.
     */
  public function destroy(string $id)
{
    $room = Room::findOrFail($id);

    $room->delete();

    return redirect()->route('admin.rooms.index');
}
}
