<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class TechnicianApiController extends Controller
{
    public function technicianBookings(Request $request)
    {
        $user = $request->user();
        $services = Booking::where('assigned_to', $user->id)->get();
        return response()->json([
        "status" => true,
        "data" => $services
        ]);
    }
}
