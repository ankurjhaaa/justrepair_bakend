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
        }

        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .company {
            font-size: 14px;
        }

        .invoice-title {
            font-size: 22px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 6px;
        }

        th {
            background: #f2f2f2;
        }

        .right {
            text-align: right;
        }

        .no-border td {
            border: none;
        }

        .total-box {
            margin-top: 10px;
            width: 40%;
            float: right;
        }

        .total-box td {
            padding: 6px;
        }

        .grand {
            font-weight: bold;
            font-size: 14px;
        }

        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 11px;
        }
    </style>
</head>

<body>

    {{-- Header --}}
    <div class="header">
        <div class="company">
            <strong>{{ $company['name'] }}</strong><br>
            {{ $company['address'] }}<br>
            Phone: {{ $company['phone'] }}<br>
            Email: {{ $company['email'] }}
        </div>

        <div class="invoice-title">
            INVOICE
        </div>
    </div>

    {{-- Invoice Info --}}
    <table class="no-border">
        <tr>
            <td>
                <strong>Bill To:</strong><br>
                {{ $customer['name'] }}<br>
                {{ $customer['phone'] }}<br>
                {{ $customer['address'] }}
            </td>
            <td class="right">
                <strong>Invoice No:</strong> {{ $invoice['invoice_no'] }}<br>
                <strong>Date:</strong> {{ $invoice['date'] }}
            </td>
        </tr>
    </table>

    {{-- Items --}}
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Description (Technician Added)</th>
                <th>Qty</th>
                <th>Rate</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item['description'] }}</td>
                    <td class="right">{{ $item['qty'] }}</td>
                    <td class="right">₹{{ $item['amount'] }}</td>
                    <td class="right">₹{{ $item['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Charges --}}
    <table class="total-box">
        <tr>
            <td>Subtotal</td>
            <td class="right">₹{{ $subtotal }}</td>
        </tr>
        <tr>
            <td>Service Charge</td>
            <td class="right">₹{{ $charges['service_charge'] }}</td>
        </tr>
        <tr>
            <td>Visiting Charge</td>
            <td class="right">₹{{ $charges['visiting_charge'] }}</td>
        </tr>
        <tr>
            <td>Discount</td>
            <td class="right">- ₹{{ $charges['discount'] }}</td>
        </tr>
        <tr class="grand">
            <td>Final Amount</td>
            <td class="right">₹{{ $invoice['final_amount'] }}</td>
        </tr>
    </table>

    <div style="clear: both"></div>

    {{-- Footer --}}
    <div class="footer">
        Thank you for choosing {{ $company['name'] }} 🙏<br>
        This is a system generated invoice.
    </div>

</body>

</html>