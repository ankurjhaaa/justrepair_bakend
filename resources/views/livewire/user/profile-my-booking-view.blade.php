<div class="bg-gray-100 min-h-screen py-8 px-4 sm:px-6">

    <div class="max-w-6xl mx-auto bg-white shadow rounded-md overflow-hidden">

        <!-- ================= HEADER ================= -->
        <div class="border-b px-6 py-5 flex items-center gap-4">

            <div class="w-14 h-14 rounded-md bg-primary text-white
                        flex items-center justify-center text-xl font-bold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div>
                <h1 class="text-lg font-bold text-gray-900">
                    {{ auth()->user()->name }}
                </h1>
                <p class="text-sm text-gray-500">
                    {{ auth()->user()->phone }}
                </p>
            </div>
        </div>

        <!-- ================= CONTENT ================= -->
        <div class="grid grid-cols-1 md:grid-cols-3">

            <!-- LEFT MENU (Desktop only) -->
            <livewire:user.component.profile-sidebar />


            <!-- RIGHT FORM -->
            <div class="md:col-span-2 p-6">
                <livewire:user.my-booking-view :booking_id="$bookingId" />
            </div>

        </div>
    </div>
</div>