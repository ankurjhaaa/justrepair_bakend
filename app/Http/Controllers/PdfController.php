<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePdf(Request $request)
    {
        

        $company = [
            'name' => 'JustRepair Services',
            'logo' => public_path('logo.png'), // optional
            'address' => 'Delhi, India',
            'phone' => '+91 9876543210',
            'email' => 'support@justrepair.in',
        ];

        $customer = [
            'name' => 'Rupesh Kumar',
            'phone' => '9999999999',
            'address' => 'Patna, Bihar',
        ];

        $items = [
            ['description' => 'Kurkure', 'qty' => 2, 'amount' => 10, 'total' => 20],
            ['description' => 'Lays Chips', 'qty' => 3, 'amount' => 15, 'total' => 45],
            ['description' => 'Cold Drink', 'qty' => 1, 'amount' => 40, 'total' => 40],
            ['description' => 'Biscuit Pack', 'qty' => 4, 'amount' => 5, 'total' => 20],
        ];

        $charges = [
            'service_charge' => 150,
            'visiting_charge' => 50,
            'discount' => 20,
        ];

        $subtotal = collect($items)->sum('total');
        $finalAmount =
            $subtotal +
            $charges['service_charge'] +
            $charges['visiting_charge'] -
            $charges['discount'];

        $invoice = [
            'invoice_no' => 'INV-' . rand(1000, 9999),
            'date' => now()->format('d M Y'),
            'final_amount' => $finalAmount,
        ];

        /*
        |--------------------------------------------------------------------------
        | 🔹 PDF Generate
        |--------------------------------------------------------------------------
        */

        $pdf = Pdf::loadView('pdf.bill-invoice', compact(
            'company',
            'customer',
            'items',
            'charges',
            'subtotal',
            'invoice'
        ))->setPaper('A4');

        return $pdf->download('bill-invoice.pdf');
    }
}
