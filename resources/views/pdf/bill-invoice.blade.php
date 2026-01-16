<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 25px;
        }

        /* Header */
        .header {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .company {
            float: left;
            width: 60%;
        }

        .invoice-box {
            float: right;
            width: 40%;
            text-align: right;
        }

        .invoice-title {
            font-size: 26px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .clear {
            clear: both;
        }

        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #444;
            padding: 8px;
        }

        th {
            background: #f2f2f2;
            font-weight: bold;
        }

        .right {
            text-align: right;
        }

        .no-border td {
            border: none;
            padding: 4px;
        }

        /* Section title */
        .section-title {
            margin-top: 25px;
            font-weight: bold;
            font-size: 14px;
        }

        /* Totals */
        .total-box {
            margin-top: 20px;
            width: 45%;
            float: right;
        }

        .grand {
            font-size: 15px;
            font-weight: bold;
            background: #f2f2f2;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 11px;
            color: #555;
        }
    </style>
</head>

<body>

{{-- ================= HEADER ================= --}}
<div class="header">
    <div class="company">
        <strong style="font-size:16px">{{ $company['name'] }}</strong><br>
        {{ $company['address'] }}<br>
        Phone: {{ $company['phone'] }}<br>
        Email: {{ $company['email'] }}
    </div>

    <div class="invoice-box">
        <div class="invoice-title">INVOICE</div>
        <strong>Invoice No:</strong> {{ $invoice['invoice_no'] }}<br>
        <strong>Date:</strong> {{ $invoice['date'] }}<br>
        <strong>Status:</strong> {{ ucfirst($invoice['status']) }}
    </div>

    <div class="clear"></div>
</div>

{{-- ================= CUSTOMER ================= --}}
<table class="no-border">
    <tr>
        <td>
            <strong>Bill To:</strong><br>
            {{ $customer['name'] }}<br>
            {{ $customer['phone'] }}<br>
            {{ $customer['address'] }}
        </td>
        <td class="right">
            <strong>Payment Method:</strong><br>
            {{ ucfirst($invoice['payment_method'] ?? 'N/A') }}
        </td>
    </tr>
</table>

{{-- ================= REQUIREMENTS ================= --}}
@if(count($requirements))
    <div class="section-title">Service Requirements</div>
    <table>
        <tbody>
            @foreach($requirements as $req)
                <tr>
                    <td>• {{ $req }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

{{-- ================= TECHNICIAN ITEMS ================= --}}
<div class="section-title">Technician Added Items</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Description</th>
            <th class="right">Qty</th>
            <th class="right">Rate</th>
            <th class="right">Total</th>
        </tr>
    </thead>
    <tbody>
        @forelse($items as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item['description'] }}</td>
                <td class="right">{{ $item['qty'] }}</td>
                <td class="right">₹{{ number_format($item['amount'], 2) }}</td>
                <td class="right">₹{{ number_format($item['total'], 2) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="right">No items added</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- ================= TOTALS ================= --}}
<table class="total-box">
    <tr>
        <td>Service Charge</td>
        <td class="right">₹{{ number_format($invoice['service_charge'], 2) }}</td>
    </tr>
    <tr>
        <td>Items Subtotal</td>
        <td class="right">₹{{ number_format($invoice['subtotal'], 2) }}</td>
    </tr>
    <tr class="grand">
        <td>Final Amount</td>
        <td class="right">₹{{ number_format($invoice['final_amount'], 2) }}</td>
    </tr>
</table>

<div class="clear"></div>

{{-- ================= FOOTER ================= --}}
<div class="footer">
    Thank you for choosing {{ $company['name'] }} 🙏 <br>
    This is a system generated invoice.
</div>

</body>
</html>
