<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>JustRepair – Trusted Home Services</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#8B0000',
                        primaryLight: '#B11212',
                        darkBg: '#0b0b0b'
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @livewireStyles
</head>

<body class="bg-white text-gray-800 overflow-x-hidden">

    <header class="sticky top-0 z-50 bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16">

                <!-- LOGO -->
                <a wire:navigate href="{{ route('home') }}" class="flex items-center gap-3 w-40 md:w-48">
                    <img src="{{ asset('logo.jpeg') }}" class="h-9 w-full object-contain" alt="JustRepair Logo" />
                </a>


                <!-- DESKTOP NAV -->
                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-700">
                    <a wire:navigate href="{{ route('home') }}" class="hover:text-primary">Home</a>
                    <a wire:navigate href="{{ route('service') }}" class="hover:text-primary">Services</a>
                    <a wire:navigate href="{{ route('aboutus') }}" class="hover:text-primary">About us</a>
                    <a wire:navigate href="{{ route('helpcenter') }}" class="hover:text-primary">Help</a>
                </nav>

                <!-- DESKTOP ACTION -->
                <div class="hidden md:flex items-center gap-4">

                    @auth
                        <div class="relative group">

                            <!-- PROFILE BUTTON -->
                            <button class="flex items-center gap-3 px-3 py-2 rounded-md
                                                                       hover:bg-gray-100 transition">

                                <!-- AVATAR -->
                                <div
                                    class="w-9 h-9 rounded-md bg-primary text-white
                                                                        flex items-center justify-center font-bold text-sm">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>

                                <!-- NAME -->
                                <div class="text-left leading-tight">
                                    <p class="text-sm font-semibold text-gray-800">
                                        {{ auth()->user()->name }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        User Account
                                    </p>
                                </div>

                                <!-- ARROW -->
                                <i class="fa-solid fa-chevron-down text-xs text-gray-500"></i>
                            </button>

                            <!-- DROPDOWN -->
                            <div class="absolute right-0 mt-2 w-56
                                                                    bg-white rounded-md shadow-lg
                                                                    border border-gray-200
                                                                    opacity-0 invisible
                                                                    group-hover:opacity-100 group-hover:visible
                                                                    transition-all duration-150 z-50">

                                <a wire:navigate href="{{ route('mybookings') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700
                                                                      hover:bg-gray-100">
                                    <i class="fa-solid fa-calendar-check text-primary"></i>
                                    My Bookings
                                </a>

                                <a wire:navigate href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700
                                                                      hover:bg-gray-100">
                                    <i class="fa-solid fa-user text-primary"></i>
                                    Profile
                                </a>

                                <a wire:navigate href="{{ route('booking') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700
                                                                      hover:bg-gray-100">
                                    <i class="fa-solid fa-plus text-primary"></i>
                                    Book Service
                                </a>

                                <div class="border-t border-gray-200"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3
                                                                               text-sm text-red-600 hover:bg-red-50">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>

                        </div>

                    @else
                        <a wire:navigate href="{{ route('login') }}" class="bg-primary text-white px-5 py-2 rounded-md
                                                                  font-semibold hover:bg-primary/90 transition">
                            Login
                        </a>
                    @endauth
                </div>


                
            </div>
        </div>
    </header>
    <!-- ================= MOBILE BOTTOM SHEET ================= -->
    <div id="mobileSheet" class="fixed inset-0 z-[60] hidden">

        <!-- BACKDROP -->
        <div id="sheetBackdrop" class="absolute inset-0 bg-black/40"></div>

        <!-- SHEET -->
        <div id="sheetPanel" class="absolute bottom-0 left-0 right-0 bg-white
                rounded-t-2xl p-6
                transition-transform duration-300
                translate-y-full">

            <!-- HANDLE -->
            <div class="w-12 h-1 bg-gray-300 rounded-full mx-auto mb-6"></div>

            <!-- PRIMARY ACTION -->
            @auth
                <a href="#" class="block w-full text-center bg-primary text-white py-3 rounded-md font-semibold">
                    Book a Service
                </a>
            @else
                <a wire:navigate href="{{ route('login') }}"
                    class="block w-full text-center bg-primary text-white py-3 rounded-md font-semibold">
                    Login / Sign Up
                </a>
            @endauth

            <!-- LINKS -->
            <div class="mt-8 space-y-5 text-gray-800 text-base">

                <a href="#" class="flex items-center gap-4">
                    <i class="fa-solid fa-house text-primary text-lg w-6"></i>
                    <span>Home</span>
                </a>

                <a href="#services" class="flex items-center gap-4">
                    <i class="fa-solid fa-screwdriver-wrench text-primary text-lg w-6"></i>
                    <span>Services</span>
                </a>

                <a href="#" class="flex items-center gap-4">
                    <i class="fa-solid fa-user-gear text-primary text-lg w-6"></i>
                    <span>Technicians</span>
                </a>

                <a href="#" class="flex items-center gap-4">
                    <i class="fa-solid fa-phone-volume text-primary text-lg w-6"></i>
                    <span>Contact</span>
                </a>

                <a href="#" class="flex items-center gap-4">
                    <i class="fa-solid fa-circle-question text-primary text-lg w-6"></i>
                    <span>Help & Support</span>
                </a>

                <a href="#" class="flex items-center gap-4">
                    <i class="fa-solid fa-file-shield text-primary text-lg w-6"></i>
                    <span>Terms & Privacy</span>
                </a>
            </div>

            <!-- LOGOUT -->
            @auth
                <form method="POST" action="{{ route('logout') }}" class="mt-8">
                    @csrf
                    <button
                        class="w-full py-3 rounded-md border border-gray-300
                                                                                                                       text-gray-700 font-medium flex items-center justify-center gap-3">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>



    <!-- ================= PAGE CONTENT ================= -->
    <main class="min-h-screen">
        {{ $slot }}
    </main>
    <!-- ================= MOBILE BOTTOM NAV ================= -->
    <div class="md:hidden fixed bottom-0 inset-x-0 z-50 bg-white border-t">

        <div class="grid grid-cols-5 h-16">

            <!-- HOME -->
            <a wire:navigate href="{{ route('home') }}" class="flex flex-col items-center justify-center text-xs
           {{ request()->routeIs('home')
    ? 'text-primary font-semibold'
    : 'text-gray-500' }}">
                <i class="fa-solid fa-house text-lg"></i>
                Home
            </a>

            <!-- SERVICES -->
            <a wire:navigate href="{{ route('service') }}" class="flex flex-col items-center justify-center text-xs
           {{ request()->routeIs('service*')
    ? 'text-primary font-semibold'
    : 'text-gray-500' }}">
                <i class="fa-solid fa-screwdriver-wrench text-lg"></i>
                Services
            </a>

            <!-- BOOK (CENTER HIGHLIGHT) -->
            <a wire:navigate href="{{ route('booking') }}" class="flex flex-col items-center justify-center text-xs
                  -mt-4">
                <div class="w-12 h-12 rounded-full bg-primary text-white
                        flex items-center justify-center shadow-md">
                    <i class="fa-solid fa-plus text-lg"></i>
                </div>
                <span class="mt-1 text-primary font-semibold">
                    Book
                </span>
            </a>

            <!-- MY BOOKINGS -->
            <a wire:navigate href="{{ route('mybookings') }}" class="flex flex-col items-center justify-center text-xs
           {{ request()->routeIs('mybookings*')
    ? 'text-primary font-semibold'
    : 'text-gray-500' }}">
                <i class="fa-solid fa-calendar-check text-lg"></i>
                Orders
            </a>

            <!-- ACCOUNT -->
            <a wire:navigate href="{{ route('mobileprofile') }}" class="flex flex-col items-center justify-center text-xs
           {{ request()->routeIs('mobileprofile')
    ? 'text-primary font-semibold'
    : 'text-gray-500' }}">
                <i class="fa-solid fa-user text-lg"></i>
                Account
            </a>

        </div>
    </div>

    <!-- ================= PREMIUM FOOTER ================= -->
    <footer class="bg-[#0e0e11] text-gray-400 hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-16">

            <!-- TOP GRID -->
            <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">

                <!-- BRAND -->
                <div>
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('logo.jpeg') }}" class="h-9 w-full object-contain" alt="JustRepair Logo" />
                    </div>

                    <p class="text-sm mt-4 leading-relaxed">
                        JustRepair helps you book trusted technicians for AC,
                        plumbing, electrical & appliance repair services —
                        fast, reliable and affordable.
                    </p>

                    <!-- SOCIAL -->
                    <div class="flex items-center gap-4 mt-6">
                        <a href="#" class="hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22 12a10 10 0 1 0-11.6 9.9v-7h-2.8V12h2.8V9.8c0-2.8 1.7-4.3 4.2-4.3 1.2 0 2.5.2 2.5.2v2.7h-1.4c-1.4 0-1.9.9-1.9 1.8V12h3.2l-.5 2.9h-2.7v7A10 10 0 0 0 22 12z" />
                            </svg>
                        </a>

                        <a href="#" class="hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M21.5 6.5a4.9 4.9 0 0 1-1.4.4 2.4 2.4 0 0 0 1-1.3 4.7 4.7 0 0 1-1.5.6A2.4 2.4 0 0 0 16.3 8c0 .2 0 .4.1.6A6.8 6.8 0 0 1 6.8 6.1a2.4 2.4 0 0 0 .7 3.2 2.4 2.4 0 0 1-1.1-.3v.1c0 1.2.9 2.3 2.1 2.6a2.4 2.4 0 0 1-1.1.1 2.4 2.4 0 0 0 2.2 1.7A4.8 4.8 0 0 1 6 14.7 6.8 6.8 0 0 0 16.5 9c0-.1 0-.3 0-.4a4.9 4.9 0 0 0 1.2-1.3z" />
                            </svg>
                        </a>

                        <a href="#" class="hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.2c3.2 0 3.6 0 4.8.1 1.1.1 1.7.2 2.1.4.5.2.9.4 1.3.8.4.4.6.8.8 1.3.2.4.3 1 .4 2.1.1 1.2.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 1.1-.2 1.7-.4 2.1-.2.5-.4.9-.8 1.3-.4.4-.8.6-1.3.8-.4.2-1 .3-2.1.4-1.2.1-1.6.1-4.8.1s-3.6 0-4.8-.1c-1.1-.1-1.7-.2-2.1-.4-.5-.2-.9-.4-1.3-.8-.4-.4-.6-.8-.8-1.3-.2-.4-.3-1-.4-2.1C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.8c.1-1.1.2-1.7.4-2.1.2-.5.4-.9.8-1.3.4-.4.8-.6 1.3-.8.4-.2 1-.3 2.1-.4C8.4 2.2 8.8 2.2 12 2.2zm0 3.4a6.4 6.4 0 1 0 0 12.8 6.4 6.4 0 0 0 0-12.8zm0 10.5a4.1 4.1 0 1 1 0-8.2 4.1 4.1 0 0 1 0 8.2zm6.6-10.7a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- COMPANY -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Company</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a wire:navigate href="{{ route('aboutus') }}" class="hover:text-white">About Us</a></li>
                        <li><a wire:navigate href="{{ route('service') }}" class="hover:text-white">Services</a></li>
                        <li><a href="#" class="hover:text-white">Become a Technician</a></li>
                        <li><a href="#" class="hover:text-white">Careers</a></li>
                    </ul>
                </div>

                <!-- SUPPORT -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Support</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a wire:navigate href="{{ route('helpcenter') }}" class="hover:text-white">Help Center</a>
                        </li>
                        <li><a wire:navigate href="{{ route('termsandcondition') }}" class="hover:text-white">Terms &
                                Conditions</a></li>
                        <li><a wire:navigate href="{{ route('privacypolicy') }}" class="hover:text-white">Privacy
                                Policy</a></li>
                    </ul>
                </div>

                <!-- APP CTA -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Get the App</h4>
                    <p class="text-sm mb-5">
                        Book services faster with our mobile app.
                    </p>

                    <div class="space-y-4">
                        <a href="#" class="flex items-center gap-4 px-5 py-3 rounded-xl
                              bg-[#1a1a1f] hover:bg-[#222229]
                              transition border border-white/10">
                            <span class="text-2xl">📱</span>
                            <div>
                                <p class="text-xs text-gray-400">Download on</p>
                                <p class="text-white font-semibold leading-tight">
                                    Google Play
                                </p>
                            </div>
                        </a>

                        <a href="#" class="flex items-center gap-4 px-5 py-3 rounded-xl
                              bg-[#1a1a1f] hover:bg-[#222229]
                              transition border border-white/10">
                            <span class="text-2xl">🍎</span>
                            <div>
                                <p class="text-xs text-gray-400">Download on</p>
                                <p class="text-white font-semibold leading-tight">
                                    App Store
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- BOTTOM BAR -->
            <div class="border-t border-white/10 mt-14 pt-6 text-center text-sm">
                © {{ date('Y') }} JustRepair. All rights reserved.
            </div>
        </div>
    </footer>


    @livewireScripts

    <script>
        function initMobileMenu() {
            const openMenu = document.getElementById('openMenu');
            const sheet = document.getElementById('mobileSheet');
            const panel = document.getElementById('sheetPanel');
            const backdrop = document.getElementById('sheetBackdrop');

            // safety check (important)
            if (!openMenu || !sheet || !panel || !backdrop) return;

            // remove old listeners (avoid duplicate binding)
            openMenu.onclick = null;
            backdrop.onclick = null;

            openMenu.onclick = () => {
                sheet.classList.remove('hidden');
                sheet.classList.add('block');
                setTimeout(() => {
                    panel.classList.remove('translate-y-full');
                }, 10);
                document.body.classList.add('overflow-hidden');
            };

            backdrop.onclick = closeSheet;

            function closeSheet() {
                panel.classList.add('translate-y-full');
                setTimeout(() => {
                    sheet.classList.add('hidden');
                    sheet.classList.remove('block');
                    document.body.classList.remove('overflow-hidden');
                }, 300);
            }
        }

        // initial load
        document.addEventListener('DOMContentLoaded', initMobileMenu);

        // 🔥 IMPORTANT: re-init after wire:navigate
        document.addEventListener('livewire:navigated', initMobileMenu);
    </script>



</body>

</html>