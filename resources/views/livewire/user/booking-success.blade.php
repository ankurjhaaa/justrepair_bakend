<div class="min-h-screen bg-gray-100 flex items-center justify-center px-4">

    <div class="w-full max-w-lg bg-white rounded-md shadow-md p-6 sm:p-8 text-center">

        <!-- SUCCESS ICON -->
        <div class="mx-auto w-16 h-16 rounded-full bg-green-100
                    flex items-center justify-center text-green-600 text-3xl">
            <i class="fa-solid fa-check"></i>
        </div>

        <!-- TITLE -->
        <h1 class="mt-4 text-2xl font-bold text-gray-900">
            Booking Confirmed!
        </h1>

        <p class="mt-2 text-sm text-gray-600">
            Your service booking has been placed successfully.
        </p>

        <!-- BOOKING INFO -->
        <div class="mt-6 border rounded-md p-4 text-left text-sm space-y-2">

            <div class="flex justify-between">
                <span class="text-gray-500">Booking ID</span>
                <span class="font-semibold text-gray-900">
                    {{ $booking->booking_id ?? 'JR-XXXX' }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Service Date</span>
                <span class="font-medium">
                    {{ optional($booking->date)->format('d M Y') ?? '-' }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Time Slot</span>
                <span class="font-medium">
                    {{ $booking->time ?? '-' }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">OTP</span>
                <span class="font-bold text-primary tracking-widest">
                    {{ $booking->otp ?? '****' }}
                </span>
            </div>

        </div>

        <!-- NOTE -->
        <p class="mt-4 text-xs text-gray-500">
            Please share the OTP with the technician after service completion.
        </p>

        <!-- ACTIONS -->
        <div class="mt-6 space-y-3">

            <a wire:navigate href="{{ route('mybookingview',$booking->booking_id) }}" class="block w-full bg-primary text-white py-3
                      rounded-md font-semibold hover:bg-primary/90 transition">
                View My Bookings
            </a>

            <a wire:navigate href="{{ route('home') }}" class="block w-full border py-3 rounded-md
                      font-medium text-gray-700 hover:bg-gray-50">
                Back to Home
            </a>

        </div>

    </div>

</div>