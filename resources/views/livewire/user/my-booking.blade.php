<div class="min-h-screen py-8">

    <div class="max-w-4xl mx-auto">



        @if($bookings->isEmpty())
            <!-- EMPTY STATE -->
            <div class="bg-white rounded-xl p-8 text-center shadow-sm">
                <p class="text-gray-500">
                    You don’t have any bookings yet.
                </p>

                <a wire:navigate href="{{ route('booking') }}"
                    class="inline-block mt-4 px-6 py-2 bg-primary text-white rounded-md font-semibold">
                    Book a Service
                </a>
            </div>
        @else

            <!-- BOOKINGS LIST -->
            <div class="space-y-5">
                @foreach($bookings as $booking)
                    <div class="bg-white rounded-xl shadow-sm p-5 border border-red-200">

                        <!-- TOP -->
                        <div class="flex items-center justify-between flex-wrap gap-3">
                            <div>
                                <p class="text-xs text-gray-500">Booking ID</p>
                                <p class="font-semibold text-gray-900">
                                    {{ $booking->booking_id }}
                                </p>
                            </div>

                            <!-- STATUS -->
                            @php
                                $statusClasses = [
                                    'completed' => 'bg-green-100 text-green-700',
                                    'confirmed' => 'bg-blue-100 text-blue-700',
                                    'cancelled' => 'bg-red-100 text-red-700',
                                    'assigned' => 'bg-indigo-100 text-indigo-700',
                                    'in_progress' => 'bg-purple-100 text-purple-700',
                                    'payment_pending' => 'bg-orange-100 text-orange-700',
                                ];

                                $badgeClass = $statusClasses[$booking->status] ?? 'bg-yellow-100 text-yellow-700';
                            @endphp
                            <span class="px-3 py-1 text-xs rounded-full {{ $badgeClass }}">
                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                            </span>


                        </div>

                        <!-- DATE / TIME -->
                        <div class="mt-3 text-sm text-gray-600 flex flex-wrap gap-6">
                            <p>📅 {{ optional($booking->date)->format('d M Y') }}</p>
                            <p>⏰ {{ $booking->time ?? '-' }}</p>
                        </div>

                        <!-- ADDRESS -->
                        <div class="mt-3 text-sm text-gray-600">
                            📍 {{ $booking->address }}, {{ $booking->city }}
                        </div>

                        <!-- ACTION -->
                        <div class="mt-4">
                            <a wire:navigate href="{{ route('mybookingview', $booking->booking_id) }}"
                                class="text-sm font-semibold text-primary hover:underline">
                                View Details →
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>

        @endif

    </div>
</div>