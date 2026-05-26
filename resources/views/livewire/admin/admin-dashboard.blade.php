<div class="space-y-6">

    <!-- PAGE TITLE -->
    <div class="flex items-center justify-between min-h-[60px]">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Dashboard Overview</h1>
            <p class="text-xs text-gray-500 mt-1">Welcome back! Here's what's happening today.</p>
        </div>
    </div>

    <!-- STATS GRID -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">

        <!-- Total Services -->
        <div class="bg-white rounded-md p-5 border border-gray-200 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500">Total Services</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $totalServices }}</h3>
                </div>
                <div class="h-10 w-10 rounded-md bg-indigo-50 border border-indigo-100 flex items-center justify-center">
                    <i class="fa-solid fa-layer-group text-indigo-600"></i>
                </div>
            </div>
            <div class="mt-3 flex items-center text-[11px] font-medium text-emerald-600">
                <i class="fa-solid fa-arrow-up mr-1"></i>
                <span>Active</span>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="bg-white rounded-md p-5 border border-gray-200 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500">Total Bookings</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $totalBookings }}</h3>
                </div>
                <div class="h-10 w-10 rounded-md bg-emerald-50 border border-emerald-100 flex items-center justify-center">
                    <i class="fa-solid fa-calendar-check text-emerald-600"></i>
                </div>
            </div>
            <div class="mt-3 flex items-center text-[11px] font-medium text-emerald-600">
                <i class="fa-solid fa-check mr-1"></i>
                <span>{{ $completedCount }} Done</span>
            </div>
        </div>

        <!-- Customers -->
        <div class="bg-white rounded-md p-5 border border-gray-200 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500">Customers</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $totalCustomers }}</h3>
                </div>
                <div class="h-10 w-10 rounded-md bg-sky-50 border border-sky-100 flex items-center justify-center">
                    <i class="fa-solid fa-users text-sky-600"></i>
                </div>
            </div>
            <div class="mt-3 flex items-center text-[11px] font-medium text-gray-500">
                <span>Registered Users</span>
            </div>
        </div>

        <!-- Pending Requests -->
        <div class="bg-white rounded-md p-5 border border-gray-200 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500">Pending</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $pendingBookings }}</h3>
                </div>
                <div class="h-10 w-10 rounded-md bg-rose-50 border border-rose-100 flex items-center justify-center">
                    <i class="fa-regular fa-clock text-rose-600"></i>
                </div>
            </div>
            <div class="mt-3 flex items-center text-[11px] font-medium text-rose-600">
                <i class="fa-solid fa-circle-exclamation mr-1"></i>
                <span>Requires Action</span>
            </div>
        </div>

    </div>

    <!-- MAIN CONTENT GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- RECENT BOOKINGS TABLE (Span 2 columns) -->
        <div class="lg:col-span-2 bg-white rounded-md border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                <h2 class="text-sm font-semibold text-gray-800">Recent Bookings</h2>
                <a wire:navigate href="{{ route('admin.bookings') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-800 transition flex items-center gap-1">
                    View All <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white border-b border-gray-100 text-[11px] uppercase tracking-wider text-gray-500 font-semibold">
                            <th class="px-5 py-3 whitespace-nowrap">Customer</th>
                            <th class="px-5 py-3 whitespace-nowrap">Services</th>
                            <th class="px-5 py-3 whitespace-nowrap">Date</th>
                            <th class="px-5 py-3 whitespace-nowrap">Status</th>
                            <th class="px-5 py-3 text-right whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs">
                        @forelse ($recentBookings as $booking)
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
                                <td class="px-5 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-md bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs mr-3 flex-shrink-0">
                                            {{ substr($booking->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $booking->name }}</div>
                                            <div class="text-[11px] text-gray-500 mt-0.5">#{{ $booking->booking_id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center flex-nowrap gap-1.5 overflow-x-auto max-w-[200px] no-scrollbar">
                                        @foreach($booking->services()->get() as $service)
                                            <span class="inline-flex flex-shrink-0 px-2 py-0.5 text-[10px] font-medium rounded-md border border-gray-200 bg-gray-50 text-gray-600 whitespace-nowrap">
                                                {{ $service->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap text-gray-600">
                                    {{ $booking->date ? $booking->date->format('M d, Y') : 'N/A' }}
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-medium border {{ $statusClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap text-right">
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
                                    <p class="text-sm text-gray-500 font-medium">No recent bookings found</p>
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
            <div class="bg-white rounded-md border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-sm font-semibold text-gray-800">Status Overview</h2>
                </div>
                <div class="p-5 space-y-4">
                    <div class="bg-emerald-50/50 rounded-md p-4 flex items-center justify-between border border-emerald-100">
                        <div>
                            <p class="text-xs font-medium text-emerald-700">Completed Bookings</p>
                        </div>
                        <p class="text-xl font-bold text-emerald-700">{{ $completedCount }}</p>
                    </div>

                    <div class="bg-amber-50/50 rounded-md p-4 flex items-center justify-between border border-amber-100">
                        <div>
                            <p class="text-xs font-medium text-amber-700">Pending Approvals</p>
                        </div>
                        <p class="text-xl font-bold text-amber-700">{{ $pendingBookings }}</p>
                    </div>
                </div>
            </div>

            <!-- QUICK LINKS -->
            <div class="bg-white rounded-md border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-sm font-semibold text-gray-800">Quick Actions</h2>
                </div>
                <div class="p-3 space-y-1">
                    <a wire:navigate href="{{ route('admin.service') }}" class="flex items-center justify-between px-3 py-2.5 hover:bg-gray-50 rounded-md transition group">
                        <span class="text-sm font-medium text-gray-700 group-hover:text-indigo-600">Manage Services</span>
                        <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
                    </a>
                    <a wire:navigate href="{{ route('admin.config') }}" class="flex items-center justify-between px-3 py-2.5 hover:bg-gray-50 rounded-md transition group">
                        <span class="text-sm font-medium text-gray-700 group-hover:text-indigo-600">App Configuration</span>
                        <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
                    </a>
                    <a wire:navigate href="{{ route('admin.setting') }}" class="flex items-center justify-between px-3 py-2.5 hover:bg-gray-50 rounded-md transition group">
                        <span class="text-sm font-medium text-gray-700 group-hover:text-indigo-600">Site Settings</span>
                        <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
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