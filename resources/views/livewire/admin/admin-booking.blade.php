<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Bookings
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Manage all customer bookings
            </p>
        </div>
    </div>

    <!-- BOOKINGS TABLE -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow">

        <!-- X-Scrollable wrapper -->
        <div class="relative w-full overflow-x-auto">
            <table class="w-full text-sm whitespace-nowrap">
                <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
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
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40">
                        <td class="px-4 py-3 font-medium">BK20260101</td>
                        <td class="px-4 py-3">
                            <p class="font-medium">Rahul Kumar</p>
                            <p class="text-xs text-gray-500">9876543210</p>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 text-xs rounded-full bg-indigo-50 text-indigo-700">
                                AC Repair
                            </span>
                        </td>
                        <td class="px-4 py-3">11 Jan 2026</td>
                        <td class="px-4 py-3">₹799</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                Pending
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <button class="text-xs px-3 py-1.5 bg-blue-100 text-blue-700 rounded-md">
                                View
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>


</div>