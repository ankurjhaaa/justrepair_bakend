<div class="space-y-6">

    <!-- PAGE TITLE -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mt-2">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">Dashboard Overview</h1>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                Welcome back! Here's what's happening today.
            </p>
        </div>
    </div>

    <!-- STATS GRID -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        <!-- Total Services -->
        <div
            class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition duration-200">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Total Services</p>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalServices }}</h3>
                </div>
                <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg">
                    <i class="fa-solid fa-screwdriver-wrench text-indigo-600 dark:text-indigo-400 text-sm"></i>
                </div>
            </div>
            <div class="mt-2 flex items-center text-[10px] text-green-600 dark:text-green-400">
                <i class="fa-solid fa-arrow-up mr-1"></i>
                <span>Active</span>
            </div>
        </div>

        <!-- Total Bookings -->
        <div
            class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition duration-200">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Total Bookings</p>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalBookings }}</h3>
                </div>
                <div class="p-2 bg-emerald-50 dark:bg-emerald-900/30 rounded-lg">
                    <i class="fa-solid fa-calendar-check text-emerald-600 dark:text-emerald-400 text-sm"></i>
                </div>
            </div>
            <div class="mt-2 flex items-center text-[10px] text-emerald-600 dark:text-emerald-400">
                <i class="fa-solid fa-check mr-1"></i>
                <span>{{ $completedCount }} Done</span>
            </div>
        </div>

        <!-- Customers -->
        <div
            class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition duration-200">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Customers</p>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalCustomers }}</h3>
                </div>
                <div class="p-2 bg-sky-50 dark:bg-sky-900/30 rounded-lg">
                    <i class="fa-solid fa-users text-sky-600 dark:text-sky-400 text-sm"></i>
                </div>
            </div>
            <div class="mt-2 flex items-center text-[10px] text-gray-500 dark:text-gray-400">
                <span>Registered</span>
            </div>
        </div>

        <!-- Pending Requests -->
        <div
            class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition duration-200">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Pending</p>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mt-1">{{ $pendingBookings }}</h3>
                </div>
                <div class="p-2 bg-rose-50 dark:bg-rose-900/30 rounded-lg">
                    <i class="fa-solid fa-clock text-rose-600 dark:text-rose-400 text-sm"></i>
                </div>
            </div>
            <div class="mt-2 flex items-center text-[10px] text-rose-600 dark:text-rose-400">
                <i class="fa-solid fa-circle-exclamation mr-1"></i>
                <span>Action</span>
            </div>
        </div>

    </div>

    <!-- MAIN CONTENT GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- RECENT BOOKINGS TABLE (Span 2 columns) -->
        <div
            class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div
                class="p-3 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800">
                <h2 class="font-bold text-sm text-gray-900 dark:text-white">Recent Bookings</h2>
                <a wire:navigate href="{{ route('admin.bookings') }}"
                    class="text-xs font-medium text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 hover:underline transition">
                    View All <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-gray-50 dark:bg-gray-700/50 text-[10px] uppercase tracking-wider text-gray-500 dark:text-gray-400 font-semibold border-b border-gray-100 dark:border-gray-700">
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Services</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-xs">
                        @forelse ($recentBookings as $booking)
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-400 dark:border-yellow-800',
                                    'confirmed' => 'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-900/30 dark:text-blue-400 dark:border-blue-800',
                                    'assigned' => 'bg-indigo-50 text-indigo-700 border-indigo-200 dark:bg-indigo-900/30 dark:text-indigo-400 dark:border-indigo-800',
                                    'in_progress' => 'bg-purple-50 text-purple-700 border-purple-200 dark:bg-purple-900/30 dark:text-purple-400 dark:border-purple-800',
                                    'completed' => 'bg-green-50 text-green-700 border-green-200 dark:bg-green-900/30 dark:text-green-400 dark:border-green-800',
                                    'cancelled' => 'bg-red-50 text-red-700 border-red-200 dark:bg-red-900/30 dark:text-red-400 dark:border-red-800',
                                    'failed' => 'bg-red-50 text-red-700 border-red-200 dark:bg-red-900/30 dark:text-red-400 dark:border-red-800',
                                    'rescheduled' => 'bg-orange-50 text-orange-700 border-orange-200 dark:bg-orange-900/30 dark:text-orange-400 dark:border-orange-800',
                                ];
                                $statusClass = $statusClasses[$booking->status] ?? $statusClasses['pending'];
                            @endphp
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition duration-150">
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="h-6 w-6 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-[10px] mr-2">
                                            {{ substr($booking->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-white">{{ $booking->name }}
                                            </div>
                                            <div class="text-[10px] text-gray-500 dark:text-gray-400">
                                                #{{ $booking->booking_id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div
                                        class="flex items-center flex-nowrap gap-1 overflow-x-auto max-w-[200px] no-scrollbar">
                                        @foreach($booking->services()->get() as $service)
                                            <span
                                                class="inline-flex flex-shrink-0 px-1.5 py-0.5 text-[10px] font-medium rounded bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 whitespace-nowrap">
                                                {{ $service->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $booking->date ? $booking->date->format('M d') : 'N/A' }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium border {{ $statusClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-right">
                                    <a wire:navigate href="{{ route('admin.bookingview', $booking->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                    <p class="text-xs">No recent bookings found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- RIGHT COLUMN: STATUS SUMMARY & QUICK ACTIONS -->
        <div class="space-y-6">

            <!-- SUMMARY CARD -->
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800">
                    <h2 class="font-bold text-sm text-gray-900 dark:text-white">Status Overview</h2>
                </div>
                <div class="p-4 space-y-3">
                    <div
                        class="bg-green-50 dark:bg-green-900/20 rounded-lg p-3 flex items-center justify-between border border-green-100 dark:border-green-800/50">
                        <div>
                            <p class="text-xs font-medium text-green-700 dark:text-green-400">Completed</p>
                        </div>
                        <p class="text-xl font-bold text-green-700 dark:text-green-400">{{ $completedCount }}</p>
                    </div>

                    <div
                        class="bg-amber-50 dark:bg-amber-900/20 rounded-lg p-3 flex items-center justify-between border border-amber-100 dark:border-amber-800/50">
                        <div>
                            <p class="text-xs font-medium text-amber-700 dark:text-amber-400">Pending</p>
                        </div>
                        <p class="text-xl font-bold text-amber-700 dark:text-amber-400">{{ $pendingBookings }}</p>
                    </div>
                </div>
            </div>

            <!-- QUICK LINKS (Optional) -->
            <div
                class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800">
                    <h2 class="font-bold text-sm text-gray-900 dark:text-white">Quick Actions</h2>
                </div>
                <div class="p-2">
                    <a wire:navigate href=""
                        class="flex items-center justify-between px-3 py-2.5 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-lg transition group">
                        <span
                            class="text-xs font-medium text-gray-700 dark:text-gray-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">Manage
                            Services</span>
                        <i class="fa-solid fa-chevron-right text-gray-400 text-[10px]"></i>
                    </a>
                    <a wire:navigate href="{{ route('admin.config') }}"
                        class="flex items-center justify-between px-3 py-2.5 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-lg transition group">
                        <span
                            class="text-xs font-medium text-gray-700 dark:text-gray-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">App
                            Configuration</span>
                        <i class="fa-solid fa-chevron-right text-gray-400 text-[10px]"></i>
                    </a>
                    <a wire:navigate href="{{ route('admin.setting') }}"
                        class="flex items-center justify-between px-3 py-2.5 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-lg transition group">
                        <span
                            class="text-xs font-medium text-gray-700 dark:text-gray-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">Site
                            Settings</span>
                        <i class="fa-solid fa-chevron-right text-gray-400 text-[10px]"></i>
                    </a>
                </div>
            </div>

        </div>

    </div>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</div>