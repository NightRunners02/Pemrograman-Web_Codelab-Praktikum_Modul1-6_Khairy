<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('room')->get();
        return response()->json($reservations);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id'        => 'required|exists:rooms,id',
            'customer_name'  => 'required|string',
            'check_in_date'  => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date'
        ]);

        // Opsional: Pastikan room tersedia sebelum menambahkan reservasi
        $room = Room::find($validated['room_id']);
        // Misal logika: Tidak boleh reservasi jika status unavailable
        if ($room->status === 'unavailable') {
            return response()->json(['message' => 'Room is currently unavailable'], 422);
        }

        $reservation = Reservation::create($validated);
        return response()->json($reservation, 201);
    }

    public function show($id)
    {
        $reservation = Reservation::with('room')->find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }
        return response()->json($reservation);
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $validated = $request->validate([
            'room_id'        => 'sometimes|required|exists:rooms,id',
            'customer_name'  => 'sometimes|required|string',
            'check_in_date'  => 'sometimes|required|date',
            'check_out_date' => 'sometimes|required|date|after_or_equal:check_in_date'
        ]);

        // Opsional: Jika room_id diganti, cek ketersediaan room baru
        if (isset($validated['room_id'])) {
            $room = Room::find($validated['room_id']);
            if ($room->status === 'unavailable') {
                return response()->json(['message' => 'Room is currently unavailable'], 422);
            }
        }

        $reservation->update($validated);
        return response()->json($reservation);
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $reservation->delete();
        return response()->json(['message' => 'Reservation deleted successfully']);
    }
}
