<div class="space-y-6">

    <!-- ================= HEADER ================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Service Overview
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Complete service configuration & analytics
            </p>
        </div>

        <div class="flex gap-2">
            <a href=""
               class="px-4 py-2 rounded-lg border text-sm font-semibold
                      text-gray-700 dark:text-gray-300
                      hover:bg-gray-100 dark:hover:bg-gray-700">
                ← Back
            </a>

            <button
                class="px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700">
                Edit Service
            </button>
        </div>
    </div>

    <!-- ================= STATS ================= -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow">
            <p class="text-xs text-gray-500">Service ID</p>
            <p class="font-semibold">#{{ $service->id ?? 12 }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow">
            <p class="text-xs text-gray-500">Total Rates</p>
            <p class="font-semibold">{{ $service->rates_count ?? 3 }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow">
            <p class="text-xs text-gray-500">Total Bookings</p>
            <p class="font-semibold">{{ $service->bookings_count ?? 124 }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow">
            <p class="text-xs text-gray-500">Status</p>
            <span class="inline-block mt-1 px-3 py-1 text-xs rounded-full
                bg-green-100 text-green-700
                dark:bg-green-900/40 dark:text-green-300">
                Active
            </span>
        </div>

    </div>

    <!-- ================= MAIN GRID ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- ===== LEFT (DETAILS) ===== -->
        <div class="lg:col-span-2 space-y-6">

            <!-- BASIC INFO -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 space-y-4">

                <div class="flex flex-col md:flex-row gap-6">
                    <img
                        src="{{ $service->image_url ?? 'https://via.placeholder.com/300x200' }}"
                        class="w-full md:w-60 h-40 object-cover rounded-lg border">

                    <div class="flex-1 space-y-2">
                        <h2 class="text-xl font-semibold">
                            {{ $service->name ?? 'AC Repair' }}
                        </h2>

                        <p class="text-sm text-gray-500">
                            Slug:
                            <span class="font-medium">{{ $service->slug ?? 'ac-repair' }}</span>
                        </p>

                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            {{ $service->description ?? 'Professional AC repair service.' }}
                        </p>

                        <p class="text-xs text-gray-400">
                            Created:
                            {{ $service->created_at?->format('d M Y, h:i A') ?? '—' }}
                        </p>

                        <p class="text-xs text-gray-400">
                            Last Updated:
                            {{ $service->updated_at?->format('d M Y, h:i A') ?? '—' }}
                        </p>
                    </div>
                </div>

            </div>

            <!-- REQUIREMENTS -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                <h3 class="text-sm font-semibold mb-3">
                    Service Requirements
                </h3>

                <div class="flex flex-wrap gap-2">
                    @forelse($service->requirements ?? [] as $req)
                        <span class="px-3 py-1 text-xs rounded-full
                            bg-indigo-50 text-indigo-700
                            dark:bg-indigo-900/40 dark:text-indigo-300">
                            {{ $req }}
                        </span>
                    @empty
                        <p class="text-sm text-gray-500">No requirements added</p>
                    @endforelse
                </div>
            </div>

            <!-- PRICING PLANS -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                <h3 class="text-sm font-semibold mb-3">
                    Pricing Plans
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm whitespace-nowrap">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left">Title</th>
                                <th class="px-4 py-2 text-left">Duration</th>
                                <th class="px-4 py-2 text-left">Price</th>
                                <th class="px-4 py-2 text-left">Discount</th>
                                <th class="px-4 py-2 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y dark:divide-gray-700">
                            <tr>
                                <td class="px-4 py-2 font-medium">Basic Check</td>
                                <td class="px-4 py-2">30 mins</td>
                                <td class="px-4 py-2">₹499</td>
                                <td class="px-4 py-2 text-green-600">₹399</td>
                                <td class="px-4 py-2">
                                    <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-700">
                                        Active
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- ===== RIGHT (ACTIONS) ===== -->
        <div class="space-y-6">

            <!-- QUICK ACTIONS -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5 space-y-3">
                <h3 class="text-sm font-semibold">
                    Quick Actions
                </h3>

                <button class="w-full px-4 py-2 rounded-md bg-indigo-600 text-white text-sm">
                    Add Pricing Plan
                </button>

                <button class="w-full px-4 py-2 rounded-md bg-blue-600 text-white text-sm">
                    View Bookings
                </button>

                <button class="w-full px-4 py-2 rounded-md bg-yellow-500 text-white text-sm">
                    Disable Service
                </button>
            </div>

            <!-- DANGER ZONE -->
            <div class="bg-red-50 dark:bg-red-900/20 rounded-xl p-5 border border-red-200 dark:border-red-800">
                <h3 class="text-sm font-semibold text-red-700 dark:text-red-300 mb-2">
                    Danger Zone
                </h3>

                <p class="text-xs text-red-600 dark:text-red-400 mb-3">
                    Deleting this service will permanently remove all related data.
                </p>

                <button class="w-full px-4 py-2 rounded-md bg-red-600 text-white text-sm">
                    Delete Service Permanently
                </button>
            </div>

        </div>
    </div>

</div>
