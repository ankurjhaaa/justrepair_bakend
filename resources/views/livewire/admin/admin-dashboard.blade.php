<div class="space-y-6">

    <!-- PAGE TITLE -->
    <div>
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Welcome to your admin panel
        </p>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        <!-- CARD -->
        <div class="bg-white dark:bg-gray-800 rounded-md p-4 shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500">Total Services</p>
                    <p class="text-2xl font-bold">{{ $totalServices }}</p>
                </div>
                <i class="fa-solid fa-screwdriver-wrench text-2xl text-indigo-500"></i>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-md p-4 shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500">Total Bookings</p>
                    <p class="text-2xl font-bold">{{ $totalBookings }}</p>
                </div>
                <i class="fa-solid fa-calendar-check text-2xl text-emerald-500"></i>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-md p-4 shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500">Customers</p>
                    <p class="text-2xl font-bold">{{ $totalCustomers }}</p>
                </div>
                <i class="fa-solid fa-users text-2xl text-sky-500"></i>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-md p-4 shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500">Pending Requests</p>
                    <p class="text-2xl font-bold">{{ $pendingBookings }}</p>
                </div>
                <i class="fa-solid fa-clock text-2xl text-rose-500"></i>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

        <div class="bg-white dark:bg-gray-800 rounded-md shadow">
            <div class="p-4 border-b dark:border-gray-700 flex-auto justify-between flex">
                <h2 class="font-semibold text-lg">Recent Bookings</h2>
                <a wire:navigate href="{{ route('admin.bookings') }}" class="text-sm hover:underline text-blue-500">view all</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left">Customer</th>
                            <th class="px-4 py-3 text-left">Service</th>
                            <th class="px-4 py-3 text-left">Date</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y dark:divide-gray-700">
                        @foreach ($recentBookings as $booking)
                            <tr>
                                <td class="px-4 py-3">{{ $booking->user->name }}</td>
                                <td>
                                    @foreach($booking->services()->get() as $service)
                                        <span
                                            class="px-2 py-0.5 text-xs rounded-full bg-indigo-50 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-200">
                                            {{ $service->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="px-4 py-3">{{ $booking->created_at->format('d M') }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-0.5 text-xs rounded-full bg-indigo-50 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-200">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <a wire:navigate href="{{ route('admin.bookingview', $booking->id) }}" class="px-2 py-1 text-xs rounded-full hover:underline text-blue-600 cursor-pointer">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <div class="bg-white dark:bg-gray-800 rounded-md shadow">
            <div class="p-4 border-b dark:border-gray-700">
                <h2 class="font-semibold text-lg">Services Overview</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left">Service</th>
                            <th class="px-4 py-3 text-left">Price</th>
                            <th class="px-4 py-3 text-left">Bookings</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y dark:divide-gray-700">
                        <tr>
                            <td class="px-4 py-3">AC Repair</td>
                            <td class="px-4 py-3">₹499</td>
                            <td class="px-4 py-3">42</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3">Mobile Repair</td>
                            <td class="px-4 py-3">₹299</td>
                            <td class="px-4 py-3">68</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> -->

    </div>

    <div class="bg-white dark:bg-gray-800 rounded-md shadow">
        <div class="p-4 border-b dark:border-gray-700">
            <h2 class="font-semibold text-lg">Booking Status</h2>
        </div>

        <div class="grid grid-cols-2 gap-4 p-4">
            <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-4 text-center">
                <p class="text-sm text-green-600">Completed</p>
                <p class="text-2xl font-bold text-green-700">{{ $completedCount }}</p>
            </div>

            <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-xl p-4 text-center">
                <p class="text-sm text-yellow-600">Pending</p>
                <p class="text-2xl font-bold text-yellow-700">{{ $pendingBookings }}</p>
            </div>
        </div>
    </div>

</div>