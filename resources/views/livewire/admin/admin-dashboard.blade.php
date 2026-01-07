<div class="space-y-6">

    <!-- PAGE TITLE -->
    <div>
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Welcome to your admin panel
        </p>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Services</p>
                    <p class="text-2xl font-bold">12</p>
                </div>
                <i class="fa-solid fa-screwdriver-wrench text-2xl text-indigo-500"></i>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Bookings</p>
                    <p class="text-2xl font-bold">245</p>
                </div>
                <i class="fa-solid fa-calendar-check text-2xl text-emerald-500"></i>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Customers</p>
                    <p class="text-2xl font-bold">180</p>
                </div>
                <i class="fa-solid fa-users text-2xl text-sky-500"></i>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pending Requests</p>
                    <p class="text-2xl font-bold">9</p>
                </div>
                <i class="fa-solid fa-clock text-2xl text-rose-500"></i>
            </div>
        </div>

    </div>

    <!-- RECENT BOOKINGS TABLE -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow">
        <div class="p-5 border-b border-gray-200 dark:border-gray-700">
            <h2 class="font-semibold text-lg">Recent Bookings</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                    <tr>
                        <th class="px-5 py-3 text-left">Customer</th>
                        <th class="px-5 py-3 text-left">Service</th>
                        <th class="px-5 py-3 text-left">Date</th>
                        <th class="px-5 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y dark:divide-gray-700">

                    <tr>
                        <td class="px-5 py-3">Rahul Kumar</td>
                        <td class="px-5 py-3">AC Repair</td>
                        <td class="px-5 py-3">10 Jan 2026</td>
                        <td class="px-5 py-3">
                            <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                Pending
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-5 py-3">Sushila Devi</td>
                        <td class="px-5 py-3">Mobile Repair</td>
                        <td class="px-5 py-3">09 Jan 2026</td>
                        <td class="px-5 py-3">
                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                Completed
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-5 py-3">Amit Sharma</td>
                        <td class="px-5 py-3">Washing Machine</td>
                        <td class="px-5 py-3">08 Jan 2026</td>
                        <td class="px-5 py-3">
                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                In Progress
                            </span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>
