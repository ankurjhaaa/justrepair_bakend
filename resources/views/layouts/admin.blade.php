<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: '#6366f1'
                    }
                }
            }
        }
    </script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @livewireStyles
</head>

<body class="h-full bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-100 transition-colors overflow-x-hidden">

    <!-- MOBILE OVERLAY -->
    <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden"></div>

    <div class="min-h-screen flex w-full overflow-x-hidden">

    <div
        x-data="{
            show: false,
            message: '',
            type: 'success',
            progress: 100,
            timer: null,
            start() {
                this.progress = 100;
                clearInterval(this.timer);
                this.timer = setInterval(() => {
                    this.progress -= 1.5;
                    if (this.progress <= 0) {
                        clearInterval(this.timer);
                        this.show = false;
                    }
                }, 100);
            }
        }"
        x-on:toast.window="
            message = $event.detail.message;
            type = $event.detail.type ?? 'success';
            show = true;
            start();
        "
        x-show="show"
        x-transition
        x-cloak
        class="fixed z-50
            top-4 right-4
            w-[calc(100%-2rem)] sm:w-full sm:max-w-sm"
    >

        <div
            :class="{
                'bg-green-600': type === 'success',
                'bg-red-600': type === 'error',
                'bg-amber-500': type === 'warning',
                'bg-sky-600': type === 'info'
            }"
            class="relative overflow-hidden
                text-white
                rounded-md shadow-xl"
        >

            <!-- CONTENT -->
            <div class="flex items-start gap-3 px-4 py-3">
                <div class="flex-1 text-sm font-medium leading-snug"
                    x-text="message"></div>

                <button
                    @click="show = false; clearInterval(timer)"
                    class="text-white/80 hover:text-white text-lg leading-none">
                    ×
                </button>
            </div>

            <!-- PROGRESS BAR -->
            <div class="h-1 bg-white/20">
                <div
                    class="h-1 bg-white/80 transition-all duration-100"
                    :style="`width: ${progress}%`">
                </div>
            </div>

        </div>
    </div>

        <!-- ================= SIDEBAR ================= -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-white dark:bg-gray-800
            border-r border-gray-200 dark:border-gray-700 flex flex-col
            transform -translate-x-full md:translate-x-0 transition-all duration-300">

            <!-- LOGO -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-xl font-bold flex items-center gap-2">
                    <i class="fa-solid fa-gauge-high text-brand"></i>
                    Admin Panel
                </h1>
            </div>

            <!-- NAV -->
            <nav class="flex-1 px-3 py-4 space-y-1 text-sm overflow-y-auto">

                @php
                    $linkBase = 'flex items-center gap-3 px-4 py-3 rounded-xl transition';
                    $active = 'bg-indigo-100 text-indigo-700 font-semibold
                            dark:bg-indigo-900/40 dark:text-indigo-300';
                    $inactive = 'hover:bg-indigo-50 text-gray-700
                                dark:text-gray-300 dark:hover:bg-gray-700';
                @endphp

                <a wire:navigate href="{{ route('admin.dashboard') }}"
                class="{{ $linkBase }} {{ request()->routeIs('admin.dashboard') ? $active : $inactive }}">
                    <i class="fa-solid fa-chart-line"></i>
                    Dashboard
                </a>

                <a wire:navigate href="{{ route('admin.service') }}"
                class="{{ $linkBase }} {{ request()->routeIs('admin.service') ? $active : $inactive }}">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    Services
                </a>

                <a wire:navigate href="{{ route('admin.servicerate') }}"
                class="{{ $linkBase }} {{ request()->routeIs('admin.servicerate') ? $active : $inactive }}">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    Services Rates
                </a>

                <a wire:navigate href="{{ route('admin.bookings') }}"
                class="{{ $linkBase }} {{ request()->routeIs('admin.bookings','admin.bookingview') ? $active : $inactive }}">
                    <i class="fa-solid fa-calendar-check"></i>
                    Bookings
                </a>

                <a wire:navigate href="{{ route('admin.customer') }}"
                class="{{ $linkBase }} {{ request()->routeIs('admin.customer','admin.customerview') ? $active : $inactive }}">
                    <i class="fa-solid fa-users"></i>
                    Customers
                </a>

                <a wire:navigate href="{{ route('admin.faqs') }}"
                class="{{ $linkBase }} {{ request()->routeIs('admin.faqs*') ? $active : $inactive }}">
                    <i class="fa-solid fa-circle-question"></i>
                    FAQs
                </a>

                <a href="#"
                class="{{ $linkBase }} {{ $inactive }}">
                    <i class="fa-solid fa-gear"></i>
                    Settings
                </a>

            </nav>



            <!-- LOGOUT -->
            <div class="px-4 py-4 border-t border-gray-200 dark:border-gray-700">
                <form action="{{ route('logout') }}" method="get">
                    <button class="w-full flex items-center justify-center gap-2 px-4 py-3
                    rounded-xl bg-red-50 dark:bg-red-500/10
                    text-red-600 dark:text-red-400 hover:bg-red-100
                    dark:hover:bg-red-500/20 transition">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </button>
                </form>
            </div>

        </aside>

        <!-- ================= MAIN ================= -->
        <div class="flex-1 flex flex-col md:ml-64 min-w-0">


            <!-- TOPBAR -->
            <header class="sticky top-0 z-30 h-16 bg-white dark:bg-gray-800
                border-b border-gray-200 dark:border-gray-700
                px-5 flex items-center justify-between">

                <div class="flex items-center gap-3">
                    <button onclick="toggleSidebar()" class="md:hidden text-xl">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <h1 class="font-semibold text-lg">Admin Panel</h1>
                </div>

                <div class="flex items-center gap-4">
                    <button onclick="toggleTheme()" class="w-9 h-9 rounded-full
                        bg-gray-100 dark:bg-gray-700 flex items-center
                        justify-center hover:scale-105 transition">
                        <i class="fa-solid fa-moon dark:hidden"></i>
                        <i class="fa-solid fa-sun hidden dark:inline text-yellow-400"></i>
                    </button>

                    <i class="fa-regular fa-bell text-xl"></i>
                    <i class="fa-solid fa-user-circle text-2xl"></i>
                </div>
            </header>

            <!-- CONTENT -->
            <main class="flex-1 p-3 md:p-7 overflow-x-hidden">
                {{ $slot }}
            </main>

        </div>
    </div>

    @livewireScripts

    <!-- JS -->
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.toggle('hidden');
        }

        (function () {
            const html = document.documentElement;

            function applyTheme() {
                const theme = localStorage.getItem('theme') || 'light';
                html.classList.toggle('dark', theme === 'dark');
            }

            window.toggleTheme = function () {
                const isDark = html.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            };

            applyTheme();
        })();
    </script>

</body>

</html>