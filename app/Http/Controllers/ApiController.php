<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Booking;
use App\Models\Faq;
use App\Models\Service;
use App\Models\ServiceRate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function faq()
    {
        try {
            $faqs = Faq::select('id', 'title', 'description')->get();
            return response()->json([
                "status" => true,
                "message" => "faq fetched success",
                "data" => $faqs,
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function service()
    {
        try {
            $services = Service::select('id', 'name', 'slug', 'image_url', 'requirements')->get();
            return response()->json([
                "statue" => true,
                "message" => "service api fetced",
                "data" => $services,
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function viewService($slug)
    {
        try {
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

        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function servicerates($slug)
    {
        try {
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
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }


    public function bookService(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|exists:users,id',
            'service_ids' => 'required|array|min:1',
            'service_ids.*' => 'exists:services,id',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'landmark' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'requirements' => 'nullable|array|min:1',
            'requirements.*' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors()->first()
            ]);
        }

        DB::beginTransaction();

        try {

            $userId = $request->user_id;


            if (!$userId) {
                if ($request->mobile) {
                    $user = User::where('phone', $request->mobile)->first();
                    if ($user) {
                        $userId = $user->id;
                        $token = $user->createToken('auth_token')->plainTextToken;
                    } else {
                        $user = User::create([
                            'name' => $request->name,
                            'phone' => $request->mobile,
                            'password' => Hash::make('password'),
                        ]);
                        $userId = $user->id;
                        $token = $user->createToken('auth_token')->plainTextToken;
                    }
                }
            }else {
                $user = User::find($userId);
                $token = null;
            }

            do {
                $bookingId = 'JR-' . now()->format('Ymd') . strtoupper(Str::random(6));
            } while (Booking::where('booking_id', $bookingId)->exists());

            $booking = Booking::create([
                'user_id' => $userId,
                'booking_id' => $bookingId,
                'service_ids' => $request->service_ids,
                'date' => $request->date,
                'time' => $request->time,
                'otp' => rand(100000, 999999),
                'name' => $request->name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'city' => $request->city,
                'landmark' => $request->landmark,
                'requirements' => $request->requirements,
            ]);

            $services = Service::whereIn('id', $booking->service_ids)->get();

            $booking_detail = [
                'id' => $booking->id,
                'booking_id' => $booking->booking_id,
                'otp' => $booking->otp,
                'date' => $booking->date,
                'time' => $booking->time,
                'status' => $booking->status,
                'total_amount' => $booking->total_amount,
                'created_at' => $booking->created_at,
                'updated_at' => $booking->updated_at,
                'services' => $services,
            ];

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Booking Success',
                'data' => [
                    'booking' => $booking_detail,
                    'user' => $user,
                    'token' => $token,
                ]
            ], 201);

        } catch (\Throwable $e) {

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
        try {
            $addresses = Address::where('user_id', $id)->get();
            return response()->json([
                "status" => true,
                "message" => "address fetched successfully",
                "data" => $addresses,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function addUserAddress(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'landmark' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors()->first()
            ]);
        }
        try {
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



    public function myBookedServices(Request $request)
    {
        try {
            $user = $request->user();

            $bookings = Booking::where('user_id', $user->id)->get();

            $booking_detail = $bookings->map(function ($booking) {

                $services = Service::whereIn('id', $booking->service_ids)->get();

                return [
                    'id' => $booking->id,
                    'booking_date' => $booking->booking_date,
                    'total_amount' => $booking->total_amount,
                    'status' => $booking->status,
                    'created_at' => $booking->created_at,
                    'updated_at' => $booking->updated_at,
                    'booking_id' => $booking->booking_id,
                    'date' => $booking->date,
                    'time' => $booking->time,
                    'data' => $services,

                ];
            });

            return response()->json([
                "status" => true,
                "message" => "user booked services fetched successfully",
                "data" => $booking_detail,
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }


    public function cancelBooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => "required|exists:bookings,booking_id"
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        try {
            $booking = Booking::where('booking_id', $request->booking_id)->first();
            if ($booking) {
                $booking->status = "cancelled";
                $booking->save();
                return response()->json([
                    'status' => true,
                    'message' => 'booking cancelled successfully'
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'booking not found'
                ]);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function viewServiceBooking(Request $request,$booking_id)
    {

        
        try {
            $booking = Booking::where('booking_id', $booking_id)->first();
            if ($booking) {
                $services = Service::whereIn('id', $booking->service_ids)->get();

                $booking_detail = [
                    'id' => $booking->id,
                    'booking_date' => $booking->booking_date,
                    'total_amount' => $booking->total_amount,
                    'status' => $booking->status,
                    'created_at' => $booking->created_at,
                    'updated_at' => $booking->updated_at,
                    'booking_id' => $booking->booking_id,
                    'date' => $booking->date,
                    'time' => $booking->time,
                    'data' => $services,

                ];

                return response()->json([
                    "status" => true,
                    "message" => "service booking details fetched successfully",
                    "data" => $booking_detail,
                ]);
            }else{
                return response()->json([
                    "status" => false,
                    "message" => "booking not found",
                    "data" => []
                ]);
            }

        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function rescheduleBooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => "required|exists:bookings,booking_id",
            'date' => 'required|date',
            'time' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        try {
            $booking = Booking::where('booking_id', $request->booking_id)->first();
            if ($booking) {
                $booking->date = $request->date;
                $booking->time = $request->time;
                $booking->status = "rescheduled";
                $booking->save();
                return response()->json([
                    'status' => true,
                    'message' => 'booking rescheduled successfully',
                    "data" => $booking,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'booking not found'
                ]);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

}
