<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between min-h-[60px]">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Technician Details</h1>
            <p class="text-xs text-gray-500 mt-1">Technician ID: #{{ $technician->id }}</p>
        </div>

        <a href="javascript:history.back()" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition shadow-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back
        </a>
    </div>

    <!-- PROFILE & PASSWORD GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- EDIT PROFILE -->
        <div class="bg-white rounded-md border border-gray-200 shadow-sm">
            <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center rounded-t-md">
                <h2 class="text-sm font-semibold text-gray-800">Edit Profile</h2>
            </div>
            <form wire:submit.prevent="updateProfile" class="p-5 space-y-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                    <input wire:model="name" type="text" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                    @error('name') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Mobile <span class="text-red-500">*</span></label>
                    <input wire:model="phone" type="text" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                    @error('phone') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Email</label>
                    <input wire:model="email" type="email" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                    @error('email') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                </div>
                <div class="pt-2 text-right">
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700 transition shadow-sm">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- CHANGE PASSWORD -->
        <div class="bg-white rounded-md border border-gray-200 shadow-sm">
            <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center rounded-t-md">
                <h2 class="text-sm font-semibold text-gray-800">Change Password</h2>
            </div>
            <form wire:submit.prevent="updatePassword" class="p-5 space-y-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">New Password <span class="text-red-500">*</span></label>
                    <input wire:model="password" type="password" placeholder="••••••••" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                    @error('password') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Confirm Password <span class="text-red-500">*</span></label>
                    <input wire:model="password_confirmation" type="password" placeholder="••••••••" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                </div>
                <div class="pt-2 text-right">
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-emerald-700 transition shadow-sm">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

    </div>

    <!-- BOOKING HISTORY -->
    <div class="bg-white rounded-md border border-gray-200 shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
            <h2 class="text-sm font-semibold text-gray-800">Assigned Jobs History</h2>
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
                                    <i class="fa-solid fa-clipboard-list text-3xl"></i>
                                </div>
                                <p class="text-sm text-gray-500 font-medium">No assigned jobs found for this technician.</p>
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