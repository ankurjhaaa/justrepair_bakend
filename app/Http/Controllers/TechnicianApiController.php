<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use function Illuminate\Support\now;

class TechnicianApiController extends Controller
{
    public function stats(Request $request)
    {
        try {
            $user = $request->user();
            $totalAssignedServices = Booking::where('assigned_to', $user->id)->count();
            $totalCompletedServices = Booking::where('assigned_to', $user->id)->where('status', 'completed')->count();
            $totalInProgressServices = Booking::where('assigned_to', $user->id)->where('status', 'in_progress')->count();
            $countJobs = Booking::where('assigned_to', $user->id)->whereDate('date', now()->toDateString())->count();
            $todaySchedule = Booking::where('assigned_to', $user->id)->whereDate('date', now()->toDateString())->count();
            $upcomingSchedule = Booking::where('assigned_to', $user->id)->whereDate('date', '>', now()->toDateString())->count();
            $data = [
                "total_assigned_services" => $totalAssignedServices,
                "total_completed_services" => $totalCompletedServices,
                "total_in_progress_services" => $totalInProgressServices,
                "total_in_countJobs" => $countJobs,
                "total_in_todaySchedule" => $todaySchedule,
                "total_in_upcomingSchedule" => $upcomingSchedule,
            ];

            return response()->json([
                "status" => true,
                "message" => "stats fetched successfully",
                "data" => $data
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function technicianBookings(Request $request)
    {
        try {

            $user = $request->user();
            $bookings = Booking::where('assigned_to', $user->id)->get();
            $bookings->each(function ($booking) {
                $booking->service_names = Service::whereIn('id', $booking->service_ids)->pluck('name');
            });

            $data = [
                "bookings" => $bookings
            ];
            return response()->json([
                "status" => true,
                "message" => "services fetched successfully",
                "data" => $data,
                
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function viewServiceBooking(Request $request, $booking_id)
    {
        $booking_detail = Booking::where('booking_id', $booking_id)->first();
        if (!$booking_detail) {
            return response()->json([
                "status" => false,
                "message" => "booking not found"
            ]);
        }
        try {
            $booking_services = Service::whereIn('id', $booking_detail->service_ids)->get();
            $user_detal = User::find($booking_detail->user_id);
            $data = [
                "booking_detail" => $booking_detail,
                "user_detail" => $user_detal,
                "service_detail" => $booking_services
            ];
            return response()->json([
                "status" => true,
                "message" => "service detail fetched",
                "data" => $data
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function assignedServiceCount(Request $request)
    {
        try {
            $user = $request->user();
            $countAllService = Booking::where('assigned_to', $user->id)->count();
            return response()->json([
                "status" => true,
                "message" => "service count successfully",
                "data" => $countAllService
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function assignedServiceInProgress(Request $request)
    {
        $user = $request->user();
        try {
            $countAllService = Booking::where('assigned_to', $user->id)->where('status', 'in_progress')->count();
            return response()->json([
                "status" => true,
                "message" => "in service count successfully",
                "data" => $countAllService
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function todayJobs(Request $request)
    {
        $user = $request->user();
        try {
            $countJobs = Booking::where('assigned_to', $user->id)->whereDate('date', now()->toDateString())->count();
            return response()->json([
                "status" => true,
                "message" => "today jobs count successfully",
                "data" => $countJobs
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function todaySchedule(Request $request)
    {
        $user = $request->user();
        try {
            $todaySchedule = Booking::where('assigned_to', $user->id)
                ->whereDate('date', now()->toDateString())
                ->get();

            $todaySchedule->each(function ($booking) {
                $booking->service_names = Service::whereIn('id', $booking->service_ids)->pluck('name');
            });
            return response()->json([
                "status" => true,
                "message" => "today jobs count successfully",
                "data" => $todaySchedule
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function upcomingSchedule(Request $request)
    {
        $user = $request->user();
        try {
            $upcomingSchedule = Booking::where('assigned_to', $user->id)
                ->whereDate('date', '>', now()->toDateString())
                ->orderBy('date', 'asc')
                ->get();

             

            $upcomingSchedule->each(function ($booking) {
                $booking->service_names = Service::whereIn('id', $booking->service_ids)->pluck('name');
            });

            return response()->json([
                "status" => true,
                "message" => "upcoming schedule fetched successfully",
                "data" => $upcomingSchedule
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function startService(Request $request, $booking_id)
    {
        $user = $request->user();
        if (!$booking_id) {
            return response()->json([
                "status" => false,
                "message" => "send booking id"
            ]);
        }
        try {
            $booking = Booking::where('booking_id', $booking_id)->first();
            $booking->start_at = now();
            $booking->status = "in_progress";
            $booking->save();
            return response()->json([
                "status" => true,
                "message" => "work start ",
                "data" => $booking
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function markComplete(Request $request, $booking_id)
    {
        $validator = Validator::make($request->all(), [
            'otp' => "required",
        ]);
        if ($validator->failed()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        if (!$booking_id) {
            return response()->json([
                "status" => false,
                "message" => "send booking id"
            ]);
        }
        try {
            $booking = Booking::where('booking_id', $booking_id)->first();
            if (!$booking) {
                return response()->json([
                    "status" => false,
                    "message" => "booking not found"
                ]);
            }
            $bookingOtp = $booking->otp;
            if ($bookingOtp != $request->otp) {
                return response()->json([
                    "status" => false,
                    "message" => "invalid otp"
                ]);
            }
            $booking->completed_at = now();
            $booking->status = "completed";
            $booking->save();
            return response()->json([
                "status" => true,
                "message" => "work complete successfully ",
                "data" => $booking
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
    public function otpVerify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => "required|exists:bookings,booking_id",
            'otp' => "required"
        ]);
        if ($validator->failed()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        try {
            $booking = Booking::where('booking_id', $request->booking_id)->first();
            if ($booking) {
                if ($booking->otp === $request->otp) {
                    $booking->otp_verified_at = now();
                    $booking->save();
                    return response()->json([
                        "status" => true,
                        "message" => "otp varified successfully",
                        "data" => $booking
                    ]);
                } else {
                    return response()->json([
                        "status" => false,
                        "message" => "invalid otp"
                    ]);
                }
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "service not found"
                ]);
            }

        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function addAdditionalInfo(Request $request, $booking_id)
    {
        $validator = Validator::make($request->all(), [
            'additional_info' => "required|array",
        ]);
        if ($validator->failed()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        try {
            $booking = Booking::where('booking_id', $booking_id)->first();
            if (!$booking) {
                return response()->json([
                    "status" => false,
                    "message" => "booking not found"
                ]);
            }
            $booking->additional_info = $request->additional_info;
            $booking->save();
            return response()->json([
                "status" => true,
                "message" => "additional info added successfully",
                "data" => $booking
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
