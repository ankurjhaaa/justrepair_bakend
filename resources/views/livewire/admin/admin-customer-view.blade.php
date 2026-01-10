<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Customer Details
            </h1>
            <p class="text-sm text-gray-500">
                Customer ID: {{ $customer->id }}
            </p>
        </div>

        <a href="javascript:history.back()"
           class="px-4 py-2 rounded-md border text-sm
                  bg-white text-gray-700
                  hover:bg-gray-100
                  dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-700">
            ← Back
        </a>
    </div>

    <!-- CUSTOMER SUMMARY -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow">
            <p class="text-xs text-gray-500">Name</p>
            <p class="font-semibold">{{ $customer->name ?? '—' }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow">
            <p class="text-xs text-gray-500">Mobile</p>
            <p class="font-semibold">{{ $customer->phone ?? '—' }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow">
            <p class="text-xs text-gray-500">Joined On</p>
            <p class="font-semibold">
                {{ $customer->created_at->format('d M Y') }}
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow">
            <p class="text-xs text-gray-500">Total Bookings</p>
            <p class="font-semibold">
                {{ $bookings->total() }}
            </p>
        </div>

    </div>

    <!-- BOOKING HISTORY -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-x-auto">

        <div class="p-4 border-b dark:border-gray-700">
            <h2 class="font-semibold">Booking History</h2>
        </div>

        <table class="w-full text-sm whitespace-nowrap
                      text-gray-700 dark:text-gray-200">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left">Booking ID</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Amount</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40">

                        <td class="px-4 py-3 font-medium">
                            {{ $booking->booking_id }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $booking->date?->format('d M Y') }}
                            <div class="text-xs text-gray-500">
                                {{ $booking->time }}
                            </div>
                        </td>

                        <td class="px-4 py-3 font-semibold">
                            ₹{{ number_format($booking->total_amount, 2) }}
                        </td>

                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full" >
                                {{ ucfirst(str_replace('_',' ', $booking->status)) }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-right">
                            <a wire:navigate href="{{ route('admin.bookingview', $booking->id) }}"
                               class="px-3 py-1.5 text-xs rounded-md
                                      bg-indigo-100 text-indigo-700
                                      dark:bg-indigo-900 dark:text-indigo-200">
                                View
                            </a>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5"
                            class="px-4 py-6 text-center text-gray-500">
                            No bookings found
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>

        <!-- Pagination -->
        <div class="p-4">
            {{ $bookings->links() }}
        </div>
    </div>

</div>
