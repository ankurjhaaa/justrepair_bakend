<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Booking;

class PdfController extends Controller
{
    public function generatePdf(Request $request)
    {
        // 1️⃣ Validate
        $request->validate([
            'booking_id' => 'required|string'
        ]);

        // 2️⃣ Booking fetch (booking_id column se)
        $booking = Booking::where('booking_id', $request->booking_id)->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Company Info (Static for now)
        |--------------------------------------------------------------------------
        */
        $company = [
            'name' => 'JustRepair Services',
            'address' => 'Delhi, India',
            'phone' => '+91 9876543210',
            'email' => 'support@justrepair.in',
        ];

        /*
        |--------------------------------------------------------------------------
        | Customer Info (booking se)
        |--------------------------------------------------------------------------
        */
        $customer = [
            'name' => $booking->name,
            'phone' => $booking->mobile,
            'address' => trim(
                ($booking->address ?? '') . ', ' .
                ($booking->city ?? '') . ', ' .
                ($booking->landmark ?? '')
            ),
        ];

        /*
        |--------------------------------------------------------------------------
        | Requirements (JSON → array)
        |--------------------------------------------------------------------------
        */
        // Requirements (already array)
        $requirements = $booking->requirements ?? [];

        // Technician items (already array)
        $additionalInfo = $booking->additional_info ?? [];
        $items = $additionalInfo['items'] ?? [];

        // Subtotal calculation
        $subtotal = collect($items)->sum(function ($item) {
            return (float) ($item['total'] ?? 0);
        });

        // Final amount (admin set)
        $service_charge = (float) $booking->total_amount;


        /*
        |--------------------------------------------------------------------------
        | Invoice Meta
        |--------------------------------------------------------------------------
        */
        $invoice = [
            'invoice_no' => $booking->booking_id,
            'date' => optional($booking->completed_at)->format('d M Y')
                ?? $booking->created_at->format('d M Y'),
            'subtotal' => $subtotal,
            'service_charge' => $service_charge,
            'final_amount' => $service_charge + $subtotal,
            'payment_method' => $booking->payment_method,
            'status' => $booking->status,
        ];

        /*
        |--------------------------------------------------------------------------
        | PDF Generate
        |--------------------------------------------------------------------------
        */
        $pdf = Pdf::loadView('pdf.bill-invoice', compact(
            'company',
            'customer',
            'requirements',
            'items',
            'invoice',
            'booking'
        ))->setPaper('A4');

        return $pdf->download('invoice-'.$booking->booking_id.'.pdf');
    }
}
