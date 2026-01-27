<div class="hidden md:block border-r bg-gray-50 p-5 space-y-2 text-sm">

    <div class="font-semibold text-gray-700 mb-4">
        Account
    </div>

    <!-- PROFILE -->
    <a wire:navigate href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-md transition
       {{ request()->routeIs('profile')
    ? 'bg-white shadow-sm text-primary font-semibold'
    : 'text-gray-700 hover:bg-white' }}">
        <i class="fa-solid fa-user w-4"></i>
        Profile
    </a>

    <!-- MY BOOKINGS -->
    <a wire:navigate href="{{ route('mybookings') }}" class="flex items-center gap-3 px-4 py-3 rounded-md transition
       {{ request()->routeIs('mybookings*')
    ? 'bg-white shadow-sm text-primary font-semibold'
    : 'text-gray-700 hover:bg-white' }}">
        <i class="fa-solid fa-calendar-check w-4"></i>
        My Bookings
    </a>

    <!-- SECURITY -->
    <a wire:navigate href="#" class="flex items-center gap-3 px-4 py-3 rounded-md transition
              text-gray-700 hover:bg-white">
        <i class="fa-solid fa-lock w-4"></i>
        Security
    </a>

    <div class="pt-3 border-t"></div>

    <!-- LOGOUT -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="w-full flex items-center gap-3 px-4 py-3 rounded-md
                   text-red-600 hover:bg-red-50 transition">
            <i class="fa-solid fa-right-from-bracket w-4"></i>
            Logout
        </button>
    </form>

</div>