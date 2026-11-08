<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $reservations = Reservation::where('user_id', Auth::id())
        ->with('room')
        ->latest()
        ->get();

    return view('reservations.index', compact('reservations'));
}

public function staffIndex()
{
    $reservations = Reservation::with(['user', 'room'])
        ->latest()
        ->get();

    return view('staff.reservations.index', compact('reservations'));
}

// Approve a pending reservation
public function confirm($id)
{
    $reservation = Reservation::findOrFail($id);

    if ($reservation->booking_status !== 'pending') {
        return back()->with('error', 'Only pending reservations can be approved.');
    }

    $reservation->update([
        'booking_status' => 'confirmed',
    ]);

    return back()->with('success', 'Reservation approved successfully!');
}

// Deny a pending reservation
public function deny($id)
{
    $reservation = Reservation::findOrFail($id);

    if ($reservation->booking_status !== 'pending') {
        return back()->with('error', 'Only pending reservations can be denied.');
    }

    $reservation->update([
        'booking_status' => 'cancelled',
    ]);

    return back()->with('success', 'Reservation denied successfully!');
}
    /**
     * Show the form for creating a new resource.
     */
    
public function create(Request $request)
{
    $rooms = Room::where('status', 'available')->get();

    $selectedRoomId = $request->query('room_id');
    $checkIn = $request->query('check_in');
    $checkOut = $request->query('check_out');

    return view('reservations.create', compact(
        'rooms',
        'selectedRoomId',
        'checkIn',
        'checkOut'
    ));
}


    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    // 1. Validate the customer's input
    $validated = $request->validate([
    'room_id' => 'required|exists:rooms,id',
    'check_in' => 'required|date|after_or_equal:today',
    'check_out' => 'required|date|after:check_in',
]);

    // 2. Start a database transaction
    $reservation = DB::transaction(function () use ($validated) {

        // Find and lock the selected room
        $room = Room::where('id', $validated['room_id'])
            ->lockForUpdate()
            ->first();

        // Check if the room still exists and is available
        if (!$room || $room->status !== 'available') {
            return null;
        }

        // 3. Check for overlapping reservations
        $conflict = Reservation::where('room_id', $room->id)
            ->whereIn('booking_status', ['pending', 'confirmed'])
            ->where('check_in', '<', $validated['check_out'])
            ->where('check_out', '>', $validated['check_in'])
            ->exists();

        if ($conflict) {
            return null;
        }

        // 4. Calculate the number of nights
        $checkIn = new \DateTime($validated['check_in']);
        $checkOut = new \DateTime($validated['check_out']);

        $nights = $checkIn->diff($checkOut)->days;

        // 5. Calculate the total amount
        $totalAmount = $room->price_per_night * $nights;

        // 6. Save the reservation
        return Reservation::create([
            'booking_reference' => 'HB-' . strtoupper(Str::random(10)),
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'total_amount' => $totalAmount,
            'booking_status' => 'pending',
        ]);
    });

    // 7. Return a message to the customer
    if (!$reservation) {
        return back()
            ->withInput()
            ->withErrors([
                'room_id' => 'This room is unavailable or already reserved for those dates.'
            ]);
    }

    return back()->with('success', 'Reservation request submitted successfully!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
