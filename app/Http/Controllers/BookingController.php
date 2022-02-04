<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bookings;

class BookingController extends Controller
{
    //GET
    public function get()
    {
        $bookings_id = bookings::all();

        if ($bookings_id) {
            return response()->json([
                'message' => 'view Booking For you Success !',
                'bookings' => $bookings_id
            ], 200);
        } else {
            return response()->json(['message' => 'Booking not found !'], 404);
        }
    }

    //POST
    public function post(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'booking_item_id' => 'required|integer',
            'booking_status' => 'required|integer',
            'start_date' => 'required|date_format:Y-m-d H:i:s',
            'end_date' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $bookings = bookings::create([
            'user_id' => $request['user_id'],
            'booking_item_id' => $request['booking_item_id'],
            'booking_status' => $request['booking_status'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
        ]);

        return response()->json([
            'bookings' => $bookings,
        ], 200);
    }
}
