<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Bookings</h1>
            <p class="text-sm text-gray-500">
                Manage all customer bookings
            </p>
        </div>
    </div>

    <!-- FILTER BAR -->
    <div class="bg-white dark:bg-gray-800 rounded-md shadow p-4">
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">

            <!-- Search -->
            <input type="text" wire:model.live="search" placeholder="Search booking / name / mobile" class="h-11 px-3 rounded-md border
           bg-white text-gray-800
           dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600
           focus:ring-2 focus:ring-indigo-500 focus:outline-none">

            <!-- Status -->
            <select wire:model.live="status" class="h-11 px-3 rounded-md border
           bg-white text-gray-800
           dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600"">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="assigned">Assigned</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>

            <!-- Date -->
            <input type="date" wire:model.live="date" class="h-11 px-3 rounded-md border
           bg-white text-gray-800
           dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">

            <!-- Reset -->
            <button
                wire:click="resetFilters"
                class="h-11 px-3 rounded-md border
                    bg-white text-gray-800
                    dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">
                Reset
            </button>


        </div>
    </div>

    <!-- BOOKINGS TABLE -->
    <div class="bg-white dark:bg-gray-800 rounded-md shadow overflow-x-auto">

        <table class="w-full text-sm whitespace-nowrap
              text-gray-700 dark:text-gray-200">
            <thead class="bg-gray-50 dark:bg-gray-700 dark:text-gray-200">

                <tr>
                    <th class="px-4 py-3 text-left">Booking ID</th>
                    <th class="px-4 py-3 text-left">Customer</th>
                    <th class="px-4 py-3 text-left">Services</th>
                    <th class="px-4 py-3 text-left">Date & Time</th>
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
                            <p class="font-medium">{{ $booking->name }}</p>
                            <p class="text-xs text-gray-500">{{ $booking->mobile }}</p>
                        </td>

                        <td class="px-4 py-3">
                            @foreach($booking->services()->get() as $service)
                                <span class="px-2 py-0.5 text-xs rounded-full bg-indigo-50 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-200">
                                    {{ $service->name }}
                                </span>
                            @endforeach
                        </td>


                        <td class="px-4 py-3">
                            {{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}<br>
                            <span class="text-xs text-gray-500">{{ $booking->time }}</span>
                        </td>

                        <td class="px-4 py-3 font-semibold">
                            ₹{{ number_format($booking->total_amount, 2) }}
                        </td>

                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full
                                    @class([
                                        'bg-yellow-100 text-yellow-700' => $booking->status === 'pending',
                                        'bg-blue-100 text-blue-700' => in_array($booking->status, ['confirmed', 'assigned']),
                                        'bg-purple-100 text-purple-700' => $booking->status === 'in_progress',
                                        'bg-green-100 text-green-700' => $booking->status === 'completed',
                                        'bg-red-100 text-red-700' => in_array($booking->status, ['cancelled', 'failed']),
                                    ])
                                ">
                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-right">
                            <a wire:navigate href="{{ route('admin.bookingview', $booking->id) }}" class="text-xs px-3 py-1.5 bg-blue-100 text-blue-700 rounded-md">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">
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