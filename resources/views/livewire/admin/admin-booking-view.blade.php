<div class="space-y-6">

    <!-- HEADER: Title & Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 min-h-[60px]">
        
        <!-- Title + Status + Date -->
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-xl font-bold text-gray-900 tracking-tight">Booking #{{ $booking->booking_id }}</h1>
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold uppercase tracking-wide border
                    {{ $booking->status === 'completed' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' :
                        ($booking->status === 'cancelled' ? 'bg-red-50 text-red-700 border-red-200' :
                        'bg-amber-50 text-amber-700 border-amber-200') }}">
                    {{ str_replace('_', ' ', $booking->status) }}
                </span>
            </div>
            <div class="flex items-center gap-3 text-xs text-gray-500 mt-1">
                <span class="flex items-center gap-1 font-medium"><i class="fa-regular fa-calendar text-gray-400"></i> {{ $booking->date?->format('F d, Y') }}</span>
                <span class="flex items-center gap-1 font-medium"><i class="fa-regular fa-clock text-gray-400"></i> {{ $booking->time }}</span>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-2 w-full sm:w-auto">
            <a href="javascript:history.back()"
                class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition shadow-sm">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back
            </a>
            <a href="{{ route('pdf.generate', $booking->booking_id) }}"
                class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white shadow-sm hover:bg-indigo-700 transition">
                <i class="fa-solid fa-file-invoice mr-2"></i> Invoice
            </a>
        </div>
    </div>


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT COLUMN: MAIN INFORMATION -->
        <div class="lg:col-span-2 space-y-6">

            <!-- 1. CUSTOMER INFO -->
            <div class="bg-white rounded-md border border-gray-200 shadow-sm">
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50 rounded-t-md">
                    <h3 class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                        <i class="fa-solid fa-user text-gray-400"></i> Customer Details
                    </h3>
                </div>
                <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-1">Full Name</label>
                        <p class="text-sm font-medium text-gray-900">{{ $booking->name }}</p>
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-1">Mobile Number</label>
                        <p class="text-sm font-medium text-gray-900 flex items-center gap-2">
                            {{ $booking->mobile }}
                            <a href="tel:{{ $booking->mobile }}" class="text-indigo-600 hover:text-indigo-800 p-1 bg-indigo-50 rounded-full w-6 h-6 flex items-center justify-center">
                                <i class="fa-solid fa-phone-flip text-[10px]"></i>
                            </a>
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-1">Address</label>
                        <p class="text-sm text-gray-700 leading-relaxed bg-gray-50 p-3 rounded-md border border-gray-100 mt-1">
                            {{ $booking->address ?? 'No address provided' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- 2. SERVICES & REQUIREMENTS -->
            <div class="bg-white rounded-md border border-gray-200 shadow-sm">
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50 rounded-t-md">
                    <h3 class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                        <i class="fa-solid fa-layer-group text-gray-400"></i> Requested Services
                    </h3>
                </div>
                <div class="p-5">
                    @if(count($booking->service_ids ?? []) > 0)
                        <div class="space-y-4">
                            @foreach($booking->service_ids as $sid)
                                <div class="p-4 rounded-md border border-gray-100 bg-white shadow-sm">
                                    <div class="flex items-start justify-between">
                                        <!-- Service Name -->
                                        <div>
                                            <h4 class="text-sm font-semibold text-gray-900 flex items-center gap-2">
                                                <div class="w-1.5 h-1.5 rounded-full bg-indigo-500"></div>
                                                {{ $servicesMap[$sid] ?? 'Unknown Service' }}
                                            </h4>
                                        </div>
                                    </div>

                                    <!-- Requirements for this service -->
                                    <div class="mt-3 pl-3.5 border-l-2 border-gray-100">
                                        @if(isset($booking->requirements[$sid]) && is_array($booking->requirements[$sid]) && count($booking->requirements[$sid]) > 0)
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($booking->requirements[$sid] as $req)
                                                    <span class="inline-flex items-center px-2 py-1 rounded border border-gray-200 bg-gray-50 text-[11px] font-medium text-gray-700">
                                                        <i class="fa-solid fa-check text-emerald-500 mr-1.5"></i> {{ $req }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-[11px] text-gray-400 italic">No specific requirements</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fa-solid fa-ban text-2xl mb-2 text-gray-300"></i>
                            <p class="text-sm">No services found for this booking.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- 3. ADMIN NOTES -->
            <div class="bg-white rounded-md border border-gray-200 shadow-sm">
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50 rounded-t-md">
                    <h3 class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                        <i class="fa-solid fa-note-sticky text-gray-400"></i> Admin Notes
                    </h3>
                </div>
                <div class="p-5">
                    <div class="relative">
                        <textarea wire:model="admin_note" rows="3"
                            class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 bg-gray-50 text-gray-900 placeholder-gray-400"
                            placeholder="Write internal notes about this booking here..."></textarea>
                    </div>
                    <div class="mt-3 flex justify-end">
                        <button wire:click="saveAdminNote"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-medium text-xs text-white uppercase tracking-wider hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition shadow-sm">
                            Save Note
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: ACTIONS -->
        <div class="space-y-6">

            <!-- 1. MANAGE STATUS -->
            <div class="bg-white rounded-md border border-gray-200 shadow-sm">
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50 rounded-t-md">
                    <h3 class="text-sm font-semibold text-gray-800">
                        Update Status
                    </h3>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Booking Status</label>
                        <select wire:model="status"
                            class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-2 bg-white text-gray-900 h-10">
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
                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-medium text-sm text-white hover:bg-indigo-700 focus:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition shadow-sm h-10">
                        Update Status
                    </button>
                </div>
            </div>

            <!-- 2. ASSIGN TECHNICIAN -->
            <div class="bg-white rounded-md border border-gray-200 shadow-sm">
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50 rounded-t-md">
                    <h3 class="text-sm font-semibold text-gray-800">
                        Assign Technician
                    </h3>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Select Technician</label>
                        <select wire:model="assigned_to"
                            class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-2 bg-white text-gray-900 h-10">
                            <option value="">-- Choose One --</option>
                            @foreach($technicians as $tech)
                                <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button wire:click="assignTechnician"
                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-medium text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition shadow-sm h-10">
                        Assign & Notify
                    </button>
                </div>
            </div>

            <!-- 3. PAYMENT DETAILS -->
            <div class="bg-white rounded-md border border-gray-200 shadow-sm">
                <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50 rounded-t-md">
                    <h3 class="text-sm font-semibold text-gray-800">
                        Payment Summary
                    </h3>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Total Amount</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm font-medium">₹</span>
                            </div>
                            <input type="number" wire:model="total_amount"
                                class="block w-full rounded-md border border-gray-300 pl-7 px-3 py-2 bg-white text-gray-900 placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm h-10"
                                placeholder="0.00">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Payment Method</label>
                        <select wire:model="payment_method"
                            class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-2 bg-white text-gray-900 h-10">
                            <option value="">-- Select Method --</option>
                            <option value="cash">Cash</option>
                            <option value="upi">UPI</option>
                            <option value="online">Online</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" wire:model="is_paid"
                                class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 w-4 h-4 cursor-pointer">
                            <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-900">Payment Received</span>
                        </label>
                    </div>
                </div>
                <div class="bg-gray-50/80 px-5 py-4 border-t border-gray-100 rounded-b-md">
                    <button wire:click="updateAmount"
                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-medium text-sm text-white hover:bg-emerald-700 focus:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition shadow-sm h-10">
                        Save Payment
                    </button>
                </div>
            </div>

        </div>

    </div>
</div>