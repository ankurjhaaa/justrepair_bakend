<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-4 space-y-6">

    <!-- HEADER: Title & Actions -->
    <div class="flex flex-col gap-4 border-b border-gray-200 dark:border-gray-700 pb-4">

        <!-- Title + Status -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <div>
                <div class="flex flex-wrap items-center gap-2 mb-1">
                    <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900 dark:text-white tracking-tight">
                        Booking #{{ $booking->booking_id }}
                    </h1>

                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded text-[10px] sm:text-xs font-semibold uppercase tracking-wide border
                    {{ $booking->status === 'completed' ? 'bg-green-50 text-green-700 border-green-200 dark:bg-green-900/20 dark:text-green-400 dark:border-green-800' :
    ($booking->status === 'cancelled' ? 'bg-red-50 text-red-700 border-red-200 dark:bg-red-900/20 dark:text-red-400 dark:border-red-800' :
        'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-900/20 dark:text-amber-400 dark:border-amber-800') }}">
                        {{ str_replace('_', ' ', $booking->status) }}
                    </span>
                </div>

                <!-- Date & Time -->
                <div
                    class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-5 text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                    <span class="flex items-center gap-1.5">
                        <i class="fa-regular fa-calendar text-gray-400 dark:text-gray-500 text-xs"></i>
                        {{ $booking->date?->format('F d, Y') }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <i class="fa-regular fa-clock text-gray-400 dark:text-gray-500 text-xs"></i>
                        {{ $booking->time }}
                    </span>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col-2 sm:flex-row gap-2 w-full sm:w-auto">

                <a href="javascript:history.back()"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition shadow-sm">
                    <i class="fa-solid fa-arrow-left mr-1.5"></i> Back
                </a>

                <a href="{{ route('pdf.generate', $booking->booking_id) }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-3 py-2 bg-brand hover:bg-indigo-700 border border-transparent rounded-md text-xs sm:text-sm font-medium text-white shadow-sm transition">
                    <i class="fa-solid fa-file-invoice mr-1.5"></i> Invoice
                </a>

            </div>
        </div>
    </div>


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- LEFT COLUMN: MAIN INFORMATION -->
        <div class="lg:col-span-2 space-y-8">

            <!-- 1. CUSTOMER INFO -->
            <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm border border-gray-200 dark:border-gray-700">
                <div
                    class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 rounded-t-lg">
                    <h3
                        class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-user text-gray-400"></i> Customer Details
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">Full
                            Name</label>
                        <p class="text-base font-medium text-gray-900 dark:text-white">{{ $booking->name }}</p>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">Mobile
                            Number</label>
                        <p class="text-base font-medium text-gray-900 dark:text-white flex items-center gap-2">
                            {{ $booking->mobile }}
                            <a href="tel:{{ $booking->mobile }}"
                                class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400">
                                <i class="fa-solid fa-phone-flip text-sm"></i>
                            </a>
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <label
                            class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">Address</label>
                        <p class="text-base text-gray-900 dark:text-gray-300 leading-relaxed">
                            {{ $booking->address ?? 'No address provided' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- 2. SERVICES & REQUIREMENTS -->
            <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm border border-gray-200 dark:border-gray-700">
                <div
                    class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 rounded-t-lg">
                    <h3
                        class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-layer-group text-gray-400"></i> Requested Services
                    </h3>
                </div>
                <div class="p-6">
                    @if(count($booking->service_ids ?? []) > 0)
                        <div class="space-y-4">
                            @foreach($booking->service_ids as $sid)
                                <div
                                    class="p-4 rounded-md border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/30">
                                    <div class="flex items-start justify-between">
                                        <!-- Service Name -->
                                        <div>
                                            <h4
                                                class="text-base font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                                {{ $servicesMap[$sid] ?? 'Unknown Service' }}
                                            </h4>
                                        </div>
                                    </div>

                                    <!-- Requirements for this service -->
                                    <div class="mt-3">
                                        @if(isset($booking->requirements[$sid]) && is_array($booking->requirements[$sid]) && count($booking->requirements[$sid]) > 0)
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($booking->requirements[$sid] as $req)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600 shadow-sm">
                                                        <i class="fa-solid fa-check text-green-500 mr-1.5 text-[10px]"></i> {{ $req }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-400 italic pl-1">No specific requirements</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fa-solid fa-ban text-2xl mb-2 text-gray-300"></i>
                            <p>No services found for this booking.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- 3. ADMIN NOTES -->
            <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm border border-gray-200 dark:border-gray-700">
                <div
                    class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 rounded-t-lg">
                    <h3
                        class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-note-sticky text-gray-400"></i> Admin Notes
                    </h3>
                </div>
                <div class="p-6">
                    <div class="relative">
                        <textarea wire:model="admin_note" rows="4"
                            class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400"
                            placeholder="Write internal notes about this booking here..."></textarea>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button wire:click="saveAdminNote"
                            class="inline-flex items-center px-5 py-2.5 bg-gray-900 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition shadow-sm">
                            Save Note
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: ACTIONS -->
        <div class="space-y-8">

            <!-- 1. MANAGE STATUS -->
            <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm border border-gray-200 dark:border-gray-700">
                <div
                    class="px-5 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 rounded-t-lg">
                    <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider">
                        Update Status
                    </h3>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-2">Booking
                            Status</label>
                        <select wire:model="status"
                            class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="assigned">Assigned</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="failed">Failed</option>
                            <option value="rescheduled">Rescheduled</option>
                        </select>
                    </div>
                    <button wire:click="updateStatus"
                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition shadow-sm">
                        Update Status
                    </button>
                </div>
            </div>

            <!-- 2. ASSIGN TECHNICIAN -->
            <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm border border-gray-200 dark:border-gray-700">
                <div
                    class="px-5 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 rounded-t-lg">
                    <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider">
                        Assign Technician
                    </h3>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-2">Select
                            Technician</label>
                        <select wire:model="assigned_to"
                            class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="">-- Choose One --</option>
                            @foreach($technicians as $tech)
                                <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button wire:click="assignTechnician"
                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-700 focus:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition shadow-sm">
                        Assign & Notify
                    </button>
                </div>
            </div>

            <!-- 3. PAYMENT DETAILS -->
            <div class="bg-white dark:bg-gray-800 rounded-md shadow-sm border border-gray-200 dark:border-gray-700">
                <div
                    class="px-5 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 rounded-t-lg">
                    <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider">
                        Payment
                    </h3>
                </div>
                <div class="p-5 space-y-5">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-2">Total
                            Amount</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm">₹</span>
                            </div>
                            <input type="number" wire:model="total_amount"
                                class="block w-full rounded-md border-gray-300 dark:border-gray-600 pl-7 px-3 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm shadow-sm"
                                placeholder="0.00">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-2">Payment
                            Method</label>
                        <select wire:model="payment_method"
                            class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option value="">-- Select Method --</option>
                            <option value="cash">Cash</option>
                            <option value="upi">UPI</option>
                            <option value="online">Online</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" wire:model="is_paid"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 w-4 h-4">
                            <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Paid Received</span>
                        </label>
                    </div>
                </div>
                <div
                    class="bg-gray-50 dark:bg-gray-700/30 px-5 py-3 border-t border-gray-200 dark:border-gray-700 rounded-b-lg">
                    <button wire:click="updateAmount"
                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition shadow-sm">
                        Update Payment
                    </button>
                </div>
            </div>

        </div>

    </div>
</div>