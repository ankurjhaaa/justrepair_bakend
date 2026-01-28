<div class="md:hidden bg-gray-100 min-h-screen flex justify-center p-5">

    <!-- MAIN CONTAINER -->
    <div class="w-full bg-white h-[80vh]  rounded-md shadow
                flex flex-col">

        <!-- ================= HEADER ================= -->
        <div class="px-4 pt-6 pb-4 flex items-center gap-4 border-b">

            <div class="w-12 h-12 rounded-md bg-primary text-white
                        flex items-center justify-center
                        text-lg font-bold">
                @auth
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                @else
                    U
                @endauth

            </div>

            <div>
                <p class="font-semibold text-gray-900 text-base leading-tight">
                    {{ auth()->user()->name ?? "User" }}
                </p>
                <p class="text-xs text-gray-500">
                    {{ auth()->user()->phone ?? "" }}
                </p>
            </div>
        </div>

        <!-- ================= CONTENT ================= -->
        <div class="flex-1 overflow-y-auto pt-4">

            <!-- ACCOUNT -->
            <div class="px-4">

                <p class="text-xs font-semibold text-gray-500 uppercase mb-2">
                    Account
                </p>

                <div class="bg-gray-50 rounded-md divide-y">
                    @auth
                        <a wire:navigate href="{{ route('profile') }}" class="flex items-center justify-between px-4 py-4">
                            <div class="flex items-center gap-4 text-gray-700">
                                <i class="fa-solid fa-user text-primary"></i>
                                Profile
                            </div>
                            <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
                        </a>

                        <a wire:navigate href="{{ route('mybookings') }}"
                            class="flex items-center justify-between px-4 py-4">
                            <div class="flex items-center gap-4 text-gray-700">
                                <i class="fa-solid fa-calendar-check text-primary"></i>
                                My Bookings
                            </div>
                            <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
                        </a>
                    @endauth

                    <a wire:navigate href="{{ route('booking') }}" class="flex items-center justify-between px-4 py-4">
                        <div class="flex items-center gap-4 text-gray-700">
                            <i class="fa-solid fa-plus text-primary"></i>
                            Book Service
                        </div>
                        <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
                    </a>

                </div>
            </div>

            <!-- SUPPORT -->
            <div class="px-4 mt-6">

                <p class="text-xs font-semibold text-gray-500 uppercase mb-2">
                    Support
                </p>

                <div class="bg-gray-50 rounded-md divide-y">

                    <a wire:navigate href="{{ route('helpcenter') }}"
                        class="flex items-center justify-between px-4 py-4">
                        <div class="flex items-center gap-4 text-gray-700">
                            <i class="fa-solid fa-circle-question text-primary"></i>
                            Help Center
                        </div>
                        <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
                    </a>

                    <a wire:navigate href="{{ route('privacypolicy') }}"
                        class="flex items-center justify-between px-4 py-4">
                        <div class="flex items-center gap-4 text-gray-700">
                            <i class="fa-solid fa-shield-halved text-primary"></i>
                            Privacy Policy
                        </div>
                        <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
                    </a>

                    <a wire:navigate href="{{ route('termsandcondition') }}"
                        class="flex items-center justify-between px-4 py-4">
                        <div class="flex items-center gap-4 text-gray-700">
                            <i class="fa-solid fa-file-contract text-primary"></i>
                            Terms & Conditions
                        </div>
                        <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
                    </a>
                    <a wire:navigate href="{{ route('aboutus') }}" class="flex items-center justify-between px-4 py-4">
                        <div class="flex items-center gap-4 text-gray-700">
                            <i class="fa-solid fa-circle-info text-primary"></i>
                            About Us
                        </div>
                        <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
                    </a>

                    <a wire:navigate href="{{ route('service') }}" class="flex items-center justify-between px-4 py-4">
                        <div class="flex items-center gap-4 text-gray-700">
                            <i class="fa-solid fa-screwdriver-wrench text-primary"></i>
                            Services
                        </div>
                        <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
                    </a>



                </div>
            </div>

        </div>

        <!-- ================= LOGOUT ================= -->
        <div class="px-4 pb-4 pt-2">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="w-full flex items-center justify-center gap-3 py-3 rounded-md text-red-600 font-semibold border border-red-200 hover:bg-red-50 transition">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </button>
                </form>
            @else
                <a wire:navigate href="{{ route('login') }}"
                    class="w-full flex items-center justify-center gap-3 py-3 rounded-md text-red-600 font-semibold border border-red-200 hover:bg-red-50 transition">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Login
                </a>
            @endauth

        </div>

    </div>
</div>