<div class=" min-h-screen py-6 ">

    <div class="max-w-5xl mx-auto">

        <div class="bg-white rounded-md shadow overflow-hidden border border-red-200">

            {{-- ================= HEADER ================= --}}
            <div class="p-5 border-b flex flex-col-2 sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <p class="text-xs text-gray-500">Booking ID</p>
                    <h1 class="text-xl font-bold text-gray-900">
                        {{ $booking->booking_id }}
                    </h1>
                    <p class="text-xs text-gray-500 mt-1">
                        Created on {{ $booking->created_at->format('d M Y, h:i A') }}
                    </p>
                </div>

                @php
                    $statusClasses = [
                        'completed' => 'bg-green-100 text-green-700',
                        'confirmed' => 'bg-blue-100 text-blue-700',
                        'assigned' => 'bg-indigo-100 text-indigo-700',
                        'in_progress' => 'bg-purple-100 text-purple-700',
                        'payment_pending' => 'bg-orange-100 text-orange-700',
                        'cancelled' => 'bg-red-100 text-red-700',
                    ];
                    $badgeClass = $statusClasses[$booking->status] ?? 'bg-yellow-100 text-yellow-700';
                @endphp

                <span class="px-3 py-1 text-xs rounded-md font-semibold h-6 {{ $badgeClass }}">
                    {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                </span>
            </div>

            {{-- ================= SERVICES ================= --}}
            <div class="p-5 border-b">
                <h2 class="text-sm font-semibold text-gray-800 mb-3">
                    Services & Requirements
                </h2>

                <div class="space-y-3">
                    @foreach($booking->requirements ?? [] as $serviceId => $reqs)
                        <div class="border rounded-md p-3">
                            <p class="font-medium text-primary text-sm mb-2">
                                {{ $servicesMap[$serviceId] ?? 'Service #' . $serviceId }}
                            </p>

                            @if(is_array($reqs) && count($reqs))
                                <ul class="list-disc ml-4 text-xs text-gray-600 space-y-1">
                                    @foreach($reqs as $req)
                                        <li>{{ $req }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-xs text-gray-400">
                                    No specific requirements
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ================= SCHEDULE ================= --}}
            <div class="p-5 border-b grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Service Date</p>
                    <p class="font-medium text-gray-800">
                        {{ optional($booking->date)->format('d M Y') }}
                    </p>
                </div>
                <div>
                    <p class="text-gray-500">Time Slot</p>
                    <p class="font-medium text-gray-800">
                        {{ $booking->time ?? '-' }}
                    </p>
                </div>
            </div>

            {{-- ================= CUSTOMER ================= --}}
            <div class="p-5 border-b text-sm">
                <h2 class="font-semibold text-gray-800 mb-2">Customer Details</h2>

                <p><span class="font-medium">Name:</span> {{ $booking->name }}</p>
                <p><span class="font-medium">Mobile:</span> {{ $booking->mobile }}</p>

                <p class="mt-2 text-gray-600">
                    {{ $booking->address }}, {{ $booking->city }}
                </p>

                @if($booking->landmark)
                    <p class="text-xs text-gray-500">
                        Landmark: {{ $booking->landmark }}
                    </p>
                @endif
            </div>

            {{-- ================= TECHNICIAN + OTP ================= --}}
            <div class="p-5 border-b text-sm">
                <h2 class="font-semibold text-gray-800 mb-2">Technician & OTP</h2>

                @if($booking->assigned_to)
                    <p class="font-medium text-gray-900">
                        {{ optional($booking->assignedTo)->name ?? 'Assigned Technician' }}
                    </p>
                    <p class="text-xs text-gray-500">
                        Assigned on {{ optional($booking->assigned_at)->format('d M Y, h:i A') }}
                    </p>
                @else
                    <p class="text-gray-500 text-sm">
                        Technician not assigned yet
                    </p>
                @endif

                {{-- OTP --}}
                @if($booking->otp)
                    <div class="mt-3 inline-flex items-center gap-3
                                                        bg-gray-100 border rounded-md px-3 py-2">
                        <span class="text-xs text-gray-500">Service OTP</span>

                        <span class="text-lg font-bold tracking-widest text-primary">
                            {{ $booking->otp }}
                        </span>

                        @if($booking->otp_verified_at)
                            <span class="text-xs text-green-600 font-semibold">
                                Verified
                            </span>
                        @else
                            <span class="text-xs text-orange-600 font-semibold">
                                Not Verified
                            </span>
                        @endif
                    </div>
                @endif
            </div>

            {{-- ================= PAYMENT ================= --}}
            <div class="p-5 bg-gray-50 text-sm flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <p><span class="font-medium">Payment Method:</span> {{ $booking->payment_method ?? 'N/A' }}</p>
                    <p>
                        <span class="font-medium">Payment Status:</span>
                        {{ $booking->is_paid ? 'Paid' : 'Pending' }}
                    </p>
                </div>

                <div class="text-right">
                    <p class="text-xs text-gray-500">Total Amount</p>
                    <p class="text-xl font-bold text-gray-900">
                        ₹ {{ number_format($booking->total_amount, 2) }}
                    </p>
                </div>
            </div>

            {{-- ================= ACTIONS ================= --}}
            <div class="p-5 flex flex-col-2 sm:flex-row gap-3 justify-end border-t">
                <a href="{{ route('pdf.generate.livewire', $booking->booking_id) }}"
                    class="px-6 py-2 rounded-md bg-primary text-white text-sm font-semibold hover:bg-primary/90">
                    Download Invoice
                </a>

                <a wire:navigate href="{{ route('mybookings') }}"
                    class="px-6 py-2 rounded-md border text-sm font-semibold text-gray-700 hover:bg-gray-100">
                    Back
                </a>
            </div>

        </div>
    </div>
</div>