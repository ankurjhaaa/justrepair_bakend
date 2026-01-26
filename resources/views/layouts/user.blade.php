<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Just-Repair</title>
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

    <!-- ================= NAVBAR ================= -->
    <header class="sticky top-0 z-50 bg-primary text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-5 py-4 flex items-center justify-between">

            <!-- Logo -->
            <div class="flex items-center gap-3">
                <img src="https://cdn-icons-png.flaticon.com/512/3063/3063822.png"
                    class="w-9 h-9 bg-white rounded-full p-1" alt="Just Repair">
                <span class="font-bold text-xl tracking-wide">
                    Just<span class="text-gray-200">Repair</span>
                </span>
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex gap-8 font-medium text-sm">
                <a href="#" class="hover:text-gray-200">Home</a>
                <a href="#" class="hover:text-gray-200">Services</a>
                <a href="#" class="hover:text-gray-200">Technicians</a>
                <a href="#" class="hover:text-gray-200">Contact</a>
            </nav>

            <!-- Button -->
            <a href="#"
                class="hidden md:inline-block bg-white text-primary px-5 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                Book Service
            </a>

            <!-- Mobile Menu Button -->
            <button id="menuBtn" class="md:hidden text-2xl">
                ☰
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-primary border-t border-red-800">
            <nav class="flex flex-col px-5 py-4 space-y-4 text-sm">
                <a href="#">Home</a>
                <a href="#">Services</a>
                <a href="#">Technicians</a>
                <a href="#">Contact</a>
                <a href="#" class="bg-white text-primary px-4 py-2 rounded-lg text-center font-semibold">
                    Book Service
                </a>
            </nav>
        </div>
    </header>

    <!-- ================= PAGE CONTENT ================= -->
    <main>
        {{ $slot }}
    </main>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-darkBg text-gray-400">
        <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-3 gap-8">

            <div>
                <h3 class="text-white font-bold text-lg">Just-Repair</h3>
                <p class="text-sm mt-3">
                    Trusted technicians for all home repair services.
                </p>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-3">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">Services</a></li>
                    <li><a href="#" class="hover:text-white">Become Technician</a></li>
                    <li><a href="#" class="hover:text-white">Support</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-3">Contact</h4>
                <p class="text-sm">support@justrepair.com</p>
                <p class="text-sm mt-1">+91 9XXXX XXXXX</p>
            </div>
        </div>

        <div class="text-center text-xs py-4 border-t border-gray-700">
            © {{ date('Y') }} Just-Repair. All rights reserved.
        </div>
    </footer>

    @livewireScripts

    <!-- Mobile Menu JS -->
    <script>
        document.getElementById('menuBtn').onclick = () => {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }
    </script>

</body>

</html>