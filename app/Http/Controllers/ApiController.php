<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Booking;
use App\Models\Faq;
use App\Models\Service;
use App\Models\ServiceRate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function faq()
    {
        $faqs = Faq::select('id', 'title', 'description')->get();
        return response()->json([
            "status" => true,
            "message" => "faq fetched success",
            "data" => $faqs,
        ]);
    }
    public function service()
    {
        $services = Service::select('id', 'name', 'slug', 'image_url', 'requirements')->get();
        return response()->json([
            "statue" => true,
            "message" => "service api fetced",
            "data" => $services,
        ]);
    }
    public function viewService($slug)
    {
        $service = Service::where('slug', $slug)->select('name', 'slug', 'image_url', 'requirements')->first();
        if (!$service) {
            return response()->json([
                "status" => false,
                "message" => "service not found",
                "data" => []
            ]);
        }
        return response()->json([
            "status" => true,
            "message" => "success",
            "data" => $service
        ]);
    }
    public function servicerates($slug)
    {
        $serviceId = Service::where('slug', $slug)->first();
        if (!$serviceId) {
            return response()->json([
                "status" => false,
                "message" => "Service not found",
                "data" => []
            ], 404);
        }
        $servicerates = ServiceRate::where('service_id', $serviceId->id)
            ->select('title', 'duration', 'price', 'discount_price', 'includes')->get();
        return response()->json([
            "status" => true,
            "message" => "ye slug se find hoga serviserate wala table se ",
            "data" => $servicerates,

        ]);
    }


    public function bookService(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'landmark' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
        ]);

        DB::beginTransaction();

        try {

            $userId = $request->user_id;

            if (!$userId) {
                $user = User::create([
                    'name' => $request->name,
                    'phone' => $request->mobile,
                    'password' => Str::random(6)
                ]);
                $userId = $user->id;
            }

            do {
                $bookingId = 'BK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
            } while (Booking::where('booking_id', $bookingId)->exists());

            $booking = Booking::create([
                'user_id' => $userId,
                'booking_id' => $bookingId,
                'service_id' => $request->service_id,
                'date' => $request->date,
                'time' => $request->time,
                'name' => $request->name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'city' => $request->city,
                'landmark' => $request->landmark,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Booking Success',
                'data' => [
                    'booking_id' => $booking->booking_id
                ]
            ], 201);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function userAddress($id)
    {
        $addresses = Address::where('user_id', $id)->get();
        return response()->json([
            "status" => true,
            "message" => "address fetched successfully",
            "data" => $addresses,
        ]);
    }
    public function addUserAddress(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'nullable|exists:users,id',
                'name' => 'required|string',
                'mobile' => 'required|string',
                'address' => 'required|string',
                'city' => 'required|string',
                'landmark' => 'required|string',

            ]);
            Address::create([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'city' => $request->city,
                'landmark' => $request->landmark,
            ]);
            return response()->json([
                "status" => true,
                "message" => "address Add Successfully",
            ], 201);

        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => "server error",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
