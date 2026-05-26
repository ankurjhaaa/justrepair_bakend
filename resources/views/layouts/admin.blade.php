<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Vite -->
    @vite(['resources/css/admin.css', 'resources/js/app.js'])

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @livewireStyles
</head>

<body class="h-full text-gray-900 antialiased" x-data="{ sidebarOpen: false }">

    <!-- Toast Notification System -->
    <div x-data="{
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
    }" x-on:toast.window="
        message = $event.detail.message;
        type = $event.detail.type ?? 'success';
        show = true;
        start();
    " x-show="show" x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2" x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak class="fixed z-[60] top-4 right-4 w-[calc(100%-2rem)] sm:w-full sm:max-w-sm pointer-events-auto">

        <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden relative">
            <div class="p-4 flex items-start">
                <div class="flex-shrink-0">
                    <template x-if="type === 'success'">
                        <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
                    </template>
                    <template x-if="type === 'error'">
                        <i class="fa-solid fa-circle-xmark text-red-500 text-lg"></i>
                    </template>
                    <template x-if="type === 'warning'">
                        <i class="fa-solid fa-triangle-exclamation text-amber-500 text-lg"></i>
                    </template>
                    <template x-if="type === 'info'">
                        <i class="fa-solid fa-circle-info text-blue-500 text-lg"></i>
                    </template>
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-medium text-gray-900" x-text="message"></p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button @click="show = false; clearInterval(timer)" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="sr-only">Close</span>
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
            </div>
            
            <!-- PROGRESS BAR -->
            <div class="h-1 bg-gray-100 w-full absolute bottom-0 left-0">
                <div :class="{
                    'bg-emerald-500': type === 'success',
                    'bg-red-500': type === 'error',
                    'bg-amber-500': type === 'warning',
                    'bg-blue-500': type === 'info'
                }" class="h-1 transition-all duration-100" :style="`width: ${progress}%`">
                </div>
            </div>
        </div>
    </div>

    <!-- MOBILE OVERLAY -->
    <div x-cloak x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-40 md:hidden" style="display: none;"></div>

    <div class="flex w-full h-full">

        <!-- ================= SIDEBAR ================= -->
        <aside x-cloak :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 flex flex-col md:translate-x-0 transition-transform duration-300 ease-in-out">

            <!-- LOGO -->
            <div class="shrink-0 px-6 h-16 flex items-center border-b border-gray-100">
                <h1 class="text-lg font-bold flex items-center gap-2.5 text-gray-900">
                    <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white">
                        <i class="fa-solid fa-bolt text-sm"></i>
                    </div>
                    <span>Admin Panel</span>
                </h1>
            </div>

            <!-- NAV -->
            <nav class="flex-1 px-4 py-6 space-y-1 text-sm overflow-y-auto">

                @php
                    $linkBase = 'flex items-center gap-3 px-3 py-2.5 rounded-md transition-colors font-medium group';
                    $active = 'bg-indigo-50 text-indigo-600';
                    $inactive = 'text-gray-600 hover:bg-gray-50 hover:text-gray-900';
                    $iconActive = 'text-indigo-600';
                    $iconInactive = 'text-gray-400 group-hover:text-gray-500';
                @endphp

                <a wire:navigate @click="sidebarOpen = false" href="{{ route('admin.dashboard') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('admin.dashboard') ? $active : $inactive }}">
                    <i class="fa-solid fa-chart-line w-5 text-center {{ request()->routeIs('admin.dashboard') ? $iconActive : $iconInactive }}"></i>
                    Dashboard
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Management</p>
                </div>

                <a wire:navigate @click="sidebarOpen = false" href="{{ route('admin.service') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('admin.service') ? $active : $inactive }}">
                    <i class="fa-solid fa-layer-group w-5 text-center {{ request()->routeIs('admin.service') ? $iconActive : $iconInactive }}"></i>
                    Services
                </a>

                <a wire:navigate @click="sidebarOpen = false" href="{{ route('admin.servicerate') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('admin.servicerate') ? $active : $inactive }}">
                    <i class="fa-solid fa-tags w-5 text-center {{ request()->routeIs('admin.servicerate') ? $iconActive : $iconInactive }}"></i>
                    Services Rates
                </a>

                <a wire:navigate @click="sidebarOpen = false" href="{{ route('admin.bookings') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('admin.bookings', 'admin.bookingview') ? $active : $inactive }}">
                    <i class="fa-solid fa-calendar-check w-5 text-center {{ request()->routeIs('admin.bookings', 'admin.bookingview') ? $iconActive : $iconInactive }}"></i>
                    Bookings
                </a>

                <a wire:navigate @click="sidebarOpen = false" href="{{ route('admin.customer') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('admin.customer', 'admin.customerview') ? $active : $inactive }}">
                    <i class="fa-solid fa-users w-5 text-center {{ request()->routeIs('admin.customer', 'admin.customerview') ? $iconActive : $iconInactive }}"></i>
                    Customers
                </a>

                <a wire:navigate @click="sidebarOpen = false" href="{{ route('admin.technician') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('admin.technician', 'admin.technicianview') ? $active : $inactive }}">
                    <i class="fa-solid fa-user-gear w-5 text-center {{ request()->routeIs('admin.technician', 'admin.technicianview') ? $iconActive : $iconInactive }}"></i>
                    Technicians
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">System</p>
                </div>

                <a wire:navigate @click="sidebarOpen = false" href="{{ route('admin.faqs') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('admin.faqs*') ? $active : $inactive }}">
                    <i class="fa-regular fa-circle-question w-5 text-center {{ request()->routeIs('admin.faqs*') ? $iconActive : $iconInactive }}"></i>
                    FAQs
                </a>
                
                <a wire:navigate @click="sidebarOpen = false" href="{{ route('admin.apis') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('admin.apis*') ? $active : $inactive }}">
                    <i class="fa-solid fa-code w-5 text-center {{ request()->routeIs('admin.apis*') ? $iconActive : $iconInactive }}"></i>
                    APIs
                </a>

                <a wire:navigate @click="sidebarOpen = false" href="{{ route('admin.config') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('admin.config') ? $active : $inactive }}">
                    <i class="fa-solid fa-sliders w-5 text-center {{ request()->routeIs('admin.config') ? $iconActive : $iconInactive }}"></i>
                    App Config
                </a>

                <a wire:navigate @click="sidebarOpen = false" href="{{ route('admin.setting') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('admin.setting') ? $active : $inactive }}">
                    <i class="fa-solid fa-gear w-5 text-center {{ request()->routeIs('admin.setting') ? $iconActive : $iconInactive }}"></i>
                    Site Settings
                </a>

            </nav>

            <!-- LOGOUT -->
            <div class="shrink-0 px-4 py-4 border-t border-gray-100">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-md bg-white border border-gray-300 text-gray-700 text-sm font-medium hover:bg-gray-50 transition-colors shadow-sm">
                        <i class="fa-solid fa-right-from-bracket text-gray-400"></i>
                        Logout
                    </button>
                </form>
            </div>

        </aside>

        <!-- ================= MAIN ================= -->
        <div class="flex-1 flex flex-col md:ml-64 min-w-0 min-h-screen">

            <!-- TOPBAR -->
            <header class="shrink-0 sticky top-0 z-30 h-16 bg-white border-b border-gray-200 px-4 sm:px-6 flex items-center justify-between shadow-sm">

                <div class="flex items-center gap-4">
                    <!-- Mobile Logo -->
                    <div class="md:hidden flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white">
                            <i class="fa-solid fa-bolt text-sm"></i>
                        </div>
                        <span class="font-bold text-gray-900">Admin Panel</span>
                    </div>
                    <!-- Optional: Breadcrumbs or Page Title could go here -->
                </div>

                <div class="flex items-center gap-3 sm:gap-5">
                    <button class="text-gray-400 hover:text-gray-600 transition-colors relative">
                        <i class="fa-regular fa-bell text-lg"></i>
                        <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                    </button>
                    
                    <div class="h-6 w-px bg-gray-200 hidden sm:block"></div>
                    
                    <div class="flex items-center gap-3 cursor-pointer">
                        <div class="w-8 h-8 rounded-full bg-indigo-100 border border-indigo-200 flex items-center justify-center text-indigo-700 font-bold text-sm">
                            A
                        </div>
                        <div class="hidden sm:block text-sm">
                            <span class="block font-medium text-gray-700">Admin User</span>
                        </div>
                        <i class="fa-solid fa-chevron-down text-xs text-gray-400 hidden sm:block"></i>
                    </div>
                </div>
            </header>

            <!-- CONTENT -->
            <main class="flex-1 p-4 pb-24 sm:p-6 lg:p-8 lg:pb-8 w-full max-w-7xl mx-auto">
                {{ $slot }}
            </main>

            <!-- MOBILE BOTTOM NAV -->
            <nav class="md:hidden fixed bottom-0 left-0 right-0 z-30 bg-white border-t border-gray-200 flex justify-around items-center h-16 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] pb-safe">
                @php
                    $bnBase = 'flex flex-col items-center justify-center w-full h-full gap-1 transition-colors';
                    $bnActive = 'text-indigo-600 font-semibold';
                    $bnInactive = 'text-gray-500 hover:text-gray-900 font-medium';
                @endphp
                
                <a wire:navigate href="{{ route('admin.dashboard') }}" class="{{ $bnBase }} {{ request()->routeIs('admin.dashboard') ? $bnActive : $bnInactive }}">
                    <i class="fa-solid fa-chart-line text-lg"></i>
                    <span class="text-[10px]">Dashboard</span>
                </a>

                <a wire:navigate href="{{ route('admin.bookings') }}" class="{{ $bnBase }} {{ request()->routeIs('admin.bookings', 'admin.bookingview') ? $bnActive : $bnInactive }}">
                    <i class="fa-solid fa-calendar-check text-lg"></i>
                    <span class="text-[10px]">Bookings</span>
                </a>

                <a wire:navigate href="{{ route('admin.customer') }}" class="{{ $bnBase }} {{ request()->routeIs('admin.customer', 'admin.customerview') ? $bnActive : $bnInactive }}">
                    <i class="fa-solid fa-users text-lg"></i>
                    <span class="text-[10px]">Customers</span>
                </a>

                <button @click="sidebarOpen = true" class="{{ $bnBase }} text-gray-500 hover:text-gray-900 font-medium">
                    <i class="fa-solid fa-bars text-lg"></i>
                    <span class="text-[10px]">Menu</span>
                </button>
            </nav>

        </div>
    </div>

    @livewireScripts

</body>

</html>