<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between min-h-[60px]">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Customer Details</h1>
            <p class="text-xs text-gray-500 mt-1">Customer ID: #{{ $customer->id }}</p>
        </div>

        <a href="javascript:history.back()" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition shadow-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back
        </a>
    </div>

    <!-- CUSTOMER SUMMARY -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        <div class="bg-white rounded-md p-5 border border-gray-200 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-1">Name</p>
                    <p class="text-lg font-bold text-gray-900">{{ $customer->name ?? '—' }}</p>
                </div>
                <div class="h-10 w-10 rounded-md bg-indigo-50 border border-indigo-100 flex items-center justify-center">
                    <i class="fa-solid fa-user text-indigo-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-md p-5 border border-gray-200 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-1">Mobile</p>
                    <p class="text-lg font-bold text-gray-900">{{ $customer->phone ?? '—' }}</p>
                </div>
                <div class="h-10 w-10 rounded-md bg-emerald-50 border border-emerald-100 flex items-center justify-center">
                    <i class="fa-solid fa-phone text-emerald-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-md p-5 border border-gray-200 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-1">Joined On</p>
                    <p class="text-lg font-bold text-gray-900">
                        {{ $customer->created_at->format('d M Y') }}
                    </p>
                </div>
                <div class="h-10 w-10 rounded-md bg-sky-50 border border-sky-100 flex items-center justify-center">
                    <i class="fa-solid fa-calendar-days text-sky-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-md p-5 border border-gray-200 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-1">Total Bookings</p>
                    <p class="text-lg font-bold text-gray-900">
                        {{ $bookings->total() }}
                    </p>
                </div>
                <div class="h-10 w-10 rounded-md bg-purple-50 border border-purple-100 flex items-center justify-center">
                    <i class="fa-solid fa-clipboard-list text-purple-600"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- BOOKING HISTORY -->
    <div class="bg-white rounded-md border border-gray-200 shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
            <h2 class="text-sm font-semibold text-gray-800">Booking History</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white border-b border-gray-100 text-[11px] uppercase tracking-wider text-gray-500 font-semibold">
                        <th class="px-5 py-3 whitespace-nowrap">Booking ID</th>
                        <th class="px-5 py-3 whitespace-nowrap">Date</th>
                        <th class="px-5 py-3 whitespace-nowrap">Amount</th>
                        <th class="px-5 py-3 whitespace-nowrap">Status</th>
                        <th class="px-5 py-3 text-right whitespace-nowrap">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 text-sm">

                    @forelse($bookings as $booking)
                        @php
                            $statusClasses = [
                                'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                'confirmed' => 'bg-blue-50 text-blue-700 border-blue-200',
                                'assigned' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                'in_progress' => 'bg-purple-50 text-purple-700 border-purple-200',
                                'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                'cancelled' => 'bg-red-50 text-red-700 border-red-200',
                                'failed' => 'bg-red-50 text-red-700 border-red-200',
                                'rescheduled' => 'bg-orange-50 text-orange-700 border-orange-200',
                            ];
                            $statusClass = $statusClasses[$booking->status] ?? $statusClasses['pending'];
                        @endphp
                        <tr class="hover:bg-gray-50/80 transition-colors">

                            <td class="px-5 py-3 font-medium text-gray-900">
                                #{{ $booking->booking_id }}
                            </td>

                            <td class="px-5 py-3">
                                <div class="text-gray-900">{{ $booking->date?->format('d M Y') }}</div>
                                <div class="text-xs text-gray-500 mt-0.5">
                                    {{ $booking->time }}
                                </div>
                            </td>

                            <td class="px-5 py-3 font-semibold text-gray-900">
                                ₹{{ number_format($booking->total_amount, 2) }}
                            </td>

                            <td class="px-5 py-3">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-medium border {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                </span>
                            </td>

                            <td class="px-5 py-3 text-right">
                                <a wire:navigate href="{{ route('admin.bookingview', $booking->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-xs transition">
                                    View Details
                                </a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center">
                                <div class="text-gray-400 mb-2">
                                    <i class="fa-regular fa-folder-open text-3xl"></i>
                                </div>
                                <p class="text-sm text-gray-500 font-medium">No bookings found for this customer.</p>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($bookings->hasPages())
            <div class="px-5 py-4 border-t border-gray-100 bg-white">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>

</div>