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
    // Display customer's reservations
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with('room')
            ->latest()
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    // Cancel customer's own reservation
    public function cancel($id)
    {
        $reservation = Reservation::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!in_array($reservation->booking_status, ['pending', 'confirmed'])) {
            return back()->with(
                'error',
                'This reservation can no longer be cancelled.'
            );
        }

        $reservation->update([
            'booking_status' => 'cancelled',
        ]);

        return back()->with(
            'success',
            'Reservation cancelled successfully!'
        );
    }

    // Display all reservations for staff and admin
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
            return back()->with(
                'error',
                'Only pending reservations can be approved.'
            );
        }

        $reservation->update([
            'booking_status' => 'confirmed',
        ]);

        return back()->with(
            'success',
            'Reservation approved successfully!'
        );
    }

    // Deny a pending reservation
    public function deny($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->booking_status !== 'pending') {
            return back()->with(
                'error',
                'Only pending reservations can be denied.'
            );
        }

        $reservation->update([
            'booking_status' => 'cancelled',
        ]);

        return back()->with(
            'success',
            'Reservation denied successfully!'
        );
    }

    // Check in a guest
    public function checkIn($id)
    {
        $reservation = Reservation::with('room')->findOrFail($id);

        if ($reservation->booking_status !== 'confirmed') {
            return back()->with(
                'error',
                'Only confirmed reservations can be checked in.'
            );
        }

        // Check whether the room is still available
        if (!$reservation->room || $reservation->room->status !== 'available') {
            return back()->with(
                'error',
                'Check-in is not allowed because this room is unavailable or under maintenance.'
            );
        }

        $today = now()->toDateString();

        // Convert reservation dates into date strings
        $checkInDate = $reservation->check_in->toDateString();
        $checkOutDate = $reservation->check_out->toDateString();

        // Prevent early check-in
        if ($today < $checkInDate) {
            return back()->with(
                'error',
                'The guest cannot check in before the scheduled check-in date.'
            );
        }

        // Prevent check-in on or after checkout date
        if ($today >= $checkOutDate) {
            return back()->with(
                'error',
                'The scheduled checkout date has already arrived. Check-in is no longer allowed.'
            );
        }

        // Record actual check-in date and time
        $reservation->update([
            'booking_status' => 'checked_in',
            'actual_check_in' => now(),
        ]);

        return back()->with(
            'success',
            'Guest checked in successfully!'
        );
    }

    // Check out a guest
    public function checkOut($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->booking_status !== 'checked_in') {
            return back()->with(
                'error',
                'Only checked-in guests can check out.'
            );
        }

        // Record actual check-out date and time
        $reservation->update([
            'booking_status' => 'completed',
            'actual_check_out' => now(),
        ]);

        return back()->with(
            'success',
            'Guest checked out successfully!'
        );
    }

    // Show reservation form
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

    // Store a new reservation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $reservation = DB::transaction(function () use ($validated) {

            $room = Room::where('id', $validated['room_id'])
                ->lockForUpdate()
                ->first();

            if (!$room || $room->status !== 'available') {
                return null;
            }

            $conflict = Reservation::where('room_id', $room->id)
                ->whereIn('booking_status', [
                    'pending',
                    'confirmed',
                    'checked_in'
                ])
                ->where('check_in', '<', $validated['check_out'])
                ->where('check_out', '>', $validated['check_in'])
                ->exists();

            if ($conflict) {
                return null;
            }

            $checkIn = new \DateTime($validated['check_in']);
            $checkOut = new \DateTime($validated['check_out']);

            $nights = $checkIn->diff($checkOut)->days;

            $totalAmount = $room->price_per_night * $nights;

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

        if (!$reservation) {
            return back()
                ->withInput()
                ->withErrors([
                    'room_id' => 'This room is unavailable or already reserved for those dates.'
                ]);
        }

        return back()->with(
            'success',
            'Reservation request submitted successfully!'
        );
    }
}
