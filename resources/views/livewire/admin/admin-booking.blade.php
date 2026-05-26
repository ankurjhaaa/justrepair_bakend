<div x-data="{ mobileFilterOpen: false }" class="space-y-5">

    <!-- HEADER -->
    <div class="flex items-center justify-between min-h-[60px]">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Bookings</h1>
            <p class="text-xs text-gray-500 mt-1">Manage all customer bookings</p>
        </div>
        
        <div class="flex items-center gap-3">
            <!-- Mobile Filter Button -->
            <button @click="mobileFilterOpen = true" class="md:hidden flex items-center gap-2 px-3 py-2 text-sm font-medium border border-gray-200 rounded-md bg-white text-gray-700 hover:bg-gray-50 active:bg-gray-100 transition-colors">
                <i class="fa-solid fa-filter text-gray-500"></i> <span>Filters</span>
            </button>
        </div>
    </div>

    <!-- DESKTOP FILTER BAR -->
    <div class="hidden md:flex flex-wrap items-center gap-3 bg-white border border-gray-200 rounded-md p-3">
        <!-- Search -->
        <div class="relative flex-1 min-w-[240px]">
            <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text" wire:model.live="search" placeholder="Search booking / name / mobile" class="w-full h-9 pl-9 pr-3 text-sm rounded-md border border-gray-200 bg-white text-gray-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-colors">
        </div>

        <!-- Status -->
        <select wire:model.live="status" class="w-40 h-9 px-3 text-sm rounded-md border border-gray-200 bg-white text-gray-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-colors">
            <option value="">All Status</option>
            <option value="pending">Pending</option>
            <option value="confirmed">Confirmed</option>
            <option value="assigned">Assigned</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
        </select>

        <!-- Date -->
        <input type="date" wire:model.live="date" class="w-40 h-9 px-3 text-sm rounded-md border border-gray-200 bg-white text-gray-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-colors">

        <!-- Reset -->
        <button wire:click="resetFilters" class="h-9 px-4 text-sm font-medium rounded-md border border-gray-200 bg-gray-50 text-gray-700 hover:bg-gray-100 transition-colors">
            Reset
        </button>
    </div>

    <!-- MOBILE FILTER BOTTOM SHEET -->
    <div x-show="mobileFilterOpen" class="relative z-50 md:hidden" x-cloak>
        <div x-show="mobileFilterOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm" @click="mobileFilterOpen = false"></div>
        <div x-show="mobileFilterOpen" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="translate-y-full" 
             x-transition:enter-end="translate-y-0" 
             x-transition:leave="transition ease-in duration-200" 
             x-transition:leave-start="translate-y-0" 
             x-transition:leave-end="translate-y-full" 
             class="fixed inset-x-0 bottom-0 bg-white rounded-t-xl p-5 border-t border-gray-200 shadow-2xl">
            
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-base font-semibold text-gray-900">Filters</h3>
                <button @click="mobileFilterOpen = false" class="p-1 text-gray-400 hover:text-gray-600 rounded-md">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Search</label>
                    <input type="text" wire:model.live="search" placeholder="Search booking / name / mobile" class="w-full h-10 px-3 text-sm rounded-md border border-gray-200 bg-white text-gray-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Status</label>
                    <select wire:model.live="status" class="w-full h-10 px-3 text-sm rounded-md border border-gray-200 bg-white text-gray-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="assigned">Assigned</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Date</label>
                    <input type="date" wire:model.live="date" class="w-full h-10 px-3 text-sm rounded-md border border-gray-200 bg-white text-gray-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                </div>

                <div class="pt-3 flex gap-3">
                    <button wire:click="resetFilters" @click="mobileFilterOpen = false" class="flex-1 h-10 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-700 hover:bg-gray-50">Reset</button>
                    <button @click="mobileFilterOpen = false" class="flex-1 h-10 text-sm font-medium rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Apply Filters</button>
                </div>
            </div>
        </div>
    </div>

    <!-- BOOKINGS TABLE -->
    <div class="bg-white border border-gray-200 rounded-md overflow-x-auto">
        <table class="w-full text-sm text-left whitespace-nowrap text-gray-700">
            <thead class="bg-gray-50 text-gray-600 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 font-medium">Booking ID</th>
                    <th class="px-4 py-3 font-medium">Customer</th>
                    <th class="px-4 py-3 font-medium">Services</th>
                    <th class="px-4 py-3 font-medium">Date & Time</th>
                    <th class="px-4 py-3 font-medium text-right">Amount</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 py-3 font-medium text-gray-900">
                            {{ $booking->booking_id }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-900">{{ $booking->name }}</div>
                            <div class="text-xs text-gray-500 mt-0.5">{{ $booking->mobile }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-1">
                                @foreach($booking->services()->get() as $service)
                                    <span class="px-2 py-0.5 text-[11px] font-medium rounded-md bg-gray-100 text-gray-700 border border-gray-200">
                                        {{ $service->name }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-gray-900">{{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}</div>
                            <div class="text-xs text-gray-500 mt-0.5">{{ $booking->time }}</div>
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900 text-right">
                            ₹{{ number_format($booking->total_amount, 2) }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-[11px] font-medium rounded-md border
                                @class([
                                    'bg-amber-50 text-amber-700 border-amber-200' => $booking->status === 'pending',
                                    'bg-blue-50 text-blue-700 border-blue-200' => in_array($booking->status, ['confirmed', 'assigned']),
                                    'bg-indigo-50 text-indigo-700 border-indigo-200' => $booking->status === 'in_progress',
                                    'bg-green-50 text-green-700 border-green-200' => $booking->status === 'completed',
                                    'bg-red-50 text-red-700 border-red-200' => in_array($booking->status, ['cancelled', 'failed']),
                                ])">
                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a wire:navigate href="{{ route('admin.bookingview', $booking->id) }}" class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium bg-white border border-gray-200 text-gray-700 rounded-md hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fa-regular fa-folder-open text-3xl mb-3 text-gray-300"></i>
                                <p class="text-sm">No bookings found</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($bookings->hasPages())
            <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
</div>