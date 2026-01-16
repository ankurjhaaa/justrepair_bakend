<div class="space-y-6">


    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Booking Details
            </h1>
            <p class="text-sm text-gray-500">
                Booking ID:
                <span class="font-semibold">{{ $booking->booking_id }}</span>
            </p>
        </div>

        <a href="javascript:history.back()" class="px-4 py-2 rounded-md border text-sm
                bg-white text-gray-700
                hover:bg-gray-100
                dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600
                dark:hover:bg-gray-700">
            ← Back
        </a>
        <form action="{{ route('pdf.generate') }}" method="post">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
            <button type="submit" class="px-4 py-2 rounded-md border text-sm
                    bg-white text-gray-700
                    hover:bg-gray-100
                    dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600
                    dark:hover:bg-gray-700">
                Download Invoice
            </button>
        </form>

    </div>

    <!-- BASIC INFO -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        @php
            $infoCard = 'bg-white dark:bg-gray-800 rounded-xl p-4 shadow';
            $label = 'text-xs text-gray-500';
            $value = 'font-semibold text-gray-800 dark:text-gray-100';
        @endphp

        <div class="{{ $infoCard }}">
            <p class="{{ $label }}">Customer</p>
            <p class="{{ $value }}">{{ $booking->name }}</p>
            <p class="text-xs text-gray-500">{{ $booking->mobile }}</p>
        </div>

        <div class="{{ $infoCard }}">
            <p class="{{ $label }}">Date & Time</p>
            <p class="{{ $value }}">
                {{ $booking->date?->format('d M Y') }}
            </p>
            <p class="text-xs text-gray-500">{{ $booking->time }}</p>
        </div>

        <div class="{{ $infoCard }}">
            <p class="{{ $label }}">Amount</p>
            <p class="{{ $value }}">₹{{ number_format($booking->total_amount,2) }}</p>
            <p class="text-xs">
                <span class="{{ $booking->is_paid ? 'text-green-600' : 'text-red-600' }}">
                    {{ $booking->is_paid ? 'Paid' : 'Unpaid' }}
                </span>
            </p>
        </div>

        <div class="{{ $infoCard }}">
            <p class="{{ $label }}">Status</p>
            <span class="inline-block mt-1 px-3 py-1 text-xs rounded-full
                bg-indigo-100 text-indigo-700
                dark:bg-indigo-900 dark:text-indigo-200">
                {{ ucfirst(str_replace('_',' ',$booking->status)) }}
            </span>
        </div>
    </div>

    <!-- SERVICES -->
     <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

         <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
             <h3 class="text-sm font-semibold mb-3">Services</h3>
             <div class="flex flex-wrap gap-2">
                 @foreach(($booking->service_ids ?? []) as $sid)
                     <span class="px-3 py-1 text-xs rounded-full
                         bg-indigo-50 text-indigo-700
                         dark:bg-indigo-900 dark:text-indigo-200">
                         {{ $servicesMap[$sid] ?? 'Unknown Service' }}
                     </span>
                 @endforeach
             </div>
         </div>
     
         <!-- REQUIREMENTS -->
         <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
             <h3 class="text-sm font-semibold mb-3">Requirements</h3>
             <div class="flex flex-wrap gap-2">
                 @forelse($booking->requirements ?? [] as $req)
                     <span class="px-3 py-1 text-xs rounded-full
                         bg-green-50 text-green-700
                         dark:bg-green-900 dark:text-green-200">
                         {{ $req }}
                     </span>
                 @empty
                     <p class="text-sm text-gray-500">No requirements</p>
                 @endforelse
             </div>
         </div>
         <!-- STATUS UPDATE -->
         <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 space-y-3">
             <h3 class="text-sm font-semibold">Update Status</h3>
     
             <select wire:model="status"
                 class="w-full h-11 px-3 rounded-md border
                        bg-white text-gray-800
                        dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">
                     <option value="pending">pending</option>
                     <option value="confirmed">confirmed</option>
                     <option value="assigned">assigned</option>
                     <option value="in_progress">in_progress</option>
                     <option value="completed">completed</option>
                     <option value="cancelled">cancelled</option>
                     <option value="failed">failed</option>
                     <option value="rescheduled">rescheduled</option>
             </select>
     
             <button wire:click="updateStatus"
                 class="w-full px-4 py-2 rounded-md bg-indigo-600 text-white">
                 Update Status
             </button>
         </div>
     </div>
   

     
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- ASSIGN TECH -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 space-y-3">
            <h3 class="text-sm font-semibold">Assign Technician</h3>
        
            <select wire:model="assigned_to"
                class="w-full h-11 px-3 rounded-md border
                    bg-white text-gray-800
                    dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">
                <option value="">Select Technician</option>
                @foreach($technicians as $tech)
                    <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                @endforeach
            </select>
        
            <button wire:click="assignTechnician"
                class="w-full px-4 py-2 rounded-md bg-blue-600 text-white">
                Assign
            </button>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 space-y-4">
            <h3 class="text-sm font-semibold">Payment Details</h3>
    
            <input type="number"
                wire:model="total_amount"
                placeholder="Enter final amount"
                class="w-full h-11 px-3 rounded-md border
                    bg-white dark:bg-gray-700 dark:text-white">
    
            <select wire:model="payment_method"
                class="w-full h-11 px-3 rounded-md border
                    bg-white dark:bg-gray-700 dark:text-white">
                <option value="">Payment Method</option>
                <option value="cash">Cash</option>
                <option value="upi">UPI</option>
                <option value="online">Online</option>
            </select>
    
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" wire:model="is_paid">
                Mark as Paid
            </label>
    
            <button wire:click="updateAmount"
                class="px-4 py-2 rounded-md bg-emerald-600 text-white">
                Save Payment
            </button>
        </div>
        <!-- ADMIN NOTE -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 space-y-3">
            <h3 class="text-sm font-semibold">Admin Note</h3>
    
            <textarea wire:model="admin_note"
                class="w-full h-28 px-3 py-2 rounded-md border
                       bg-white text-gray-800
                       dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">
            </textarea>
    
            <button wire:click="saveAdminNote"
                class="px-4 py-2 rounded-md bg-green-600 text-white">
                Save Note
            </button>
        </div>

    </div>

</div>
