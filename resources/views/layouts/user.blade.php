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

    @livewireStyles
</head>

<body class="bg-white text-gray-800 overflow-x-hidden">

    <header class="sticky top-0 z-50 bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16">

                <!-- LOGO -->
                <a wire:navigate href="{{ route('home') }}" class="flex items-center gap-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/3063/3063822.png" class="w-9 h-9 rounded-md" />
                    <span class="font-bold text-lg text-gray-900">
                        Just<span class="text-primary">Repair</span>
                    </span>
                </a>

                <!-- DESKTOP NAV -->
                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-700">
                    <a href="#" class="hover:text-primary">Home</a>
                    <a href="#services" class="hover:text-primary">Services</a>
                    <a href="#" class="hover:text-primary">Technicians</a>
                    <a href="#" class="hover:text-primary">Contact</a>
                    <a href="#" class="hover:text-primary">Support</a>
                </nav>

                <!-- DESKTOP ACTION -->
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <a href="#" class="bg-primary text-white px-5 py-2 rounded-md font-semibold">
                            Book Service
                        </a>
                    @else
                        <a wire:navigate href="{{ route('login') }}"
                            class="bg-primary text-white px-5 py-2 rounded-md font-semibold">
                            Login
                        </a>
                    @endauth
                </div>

                <!-- MOBILE BUTTON -->
                <button id="openMenu" class="md:hidden">
                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
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
                    <!-- Home -->
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10l9-7 9 7v10a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2V12H9v8a2 2 0 0 1-2 2H3z" />
                    </svg>
                    <span>Home</span>
                </a>

                <a href="#services" class="flex items-center gap-4">
                    <!-- Services -->
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.7 6.3a1 1 0 0 0-1.4 0L6 13.6V18h4.4l7.3-7.3a1 1 0 0 0 0-1.4z" />
                    </svg>
                    <span>Services</span>
                </a>

                <a href="#" class="flex items-center gap-4">
                    <!-- Technicians -->
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 20h14v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2zM12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" />
                    </svg>
                    <span>Technicians</span>
                </a>

                <a href="#" class="flex items-center gap-4">
                    <!-- Contact -->
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5h18M8 5v14m8-14v14" />
                    </svg>
                    <span>Contact</span>
                </a>

                <a href="#" class="flex items-center gap-4">
                    <!-- Support -->
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18.4 14.6a8 8 0 1 0-12.8 0" />
                    </svg>
                    <span>Help & Support</span>
                </a>

                <a href="#" class="flex items-center gap-4">
                    <!-- Policy -->
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 6H7a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h7l5 5v13a2 2 0 0 1-2 2z" />
                    </svg>
                    <span>Terms & Privacy</span>
                </a>
            </div>

            <!-- LOGOUT -->
            @auth
                <form method="POST" action="{{ route('logout') }}" class="mt-8">
                    @csrf
                    <button class="w-full py-3 rounded-md border border-gray-300 text-gray-700 font-medium">
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

    <!-- ================= PREMIUM FOOTER ================= -->
    <footer class="bg-[#0e0e11] text-gray-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-16">

            <!-- TOP GRID -->
            <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">

                <!-- BRAND -->
                <div>
                    <div class="flex items-center gap-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/3063/3063822.png"
                            class="w-10 h-10 bg-white rounded-full p-1" alt="JustRepair" />
                        <span class="text-white text-xl font-bold">
                            Just<span class="text-primary">Repair</span>
                        </span>
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
                        <li><a href="#" class="hover:text-white">About Us</a></li>
                        <li><a href="#" class="hover:text-white">Services</a></li>
                        <li><a href="#" class="hover:text-white">Become a Technician</a></li>
                        <li><a href="#" class="hover:text-white">Careers</a></li>
                    </ul>
                </div>

                <!-- SUPPORT -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Support</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-white">Help Center</a></li>
                        <li><a href="#" class="hover:text-white">Terms & Conditions</a></li>
                        <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
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

    <!-- MOBILE MENU JS -->
    <script>
        const openMenu = document.getElementById('openMenu');
        const sheet = document.getElementById('mobileSheet');
        const panel = document.getElementById('sheetPanel');
        const backdrop = document.getElementById('sheetBackdrop');

        openMenu.addEventListener('click', () => {
            sheet.classList.remove('hidden');
            setTimeout(() => panel.classList.remove('translate-y-full'), 10);
            document.body.classList.add('overflow-hidden');
        });

        backdrop.addEventListener('click', closeSheet);

        function closeSheet() {
            panel.classList.add('translate-y-full');
            setTimeout(() => {
                sheet.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300);
        }
    </script>


</body>

</html>