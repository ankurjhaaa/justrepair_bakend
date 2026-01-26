<div>
    <!-- ================= JUST-REPAIR HERO ================= -->
    <section class="relative w-full min-h-screen overflow-hidden">


        <!-- BACKGROUND GRADIENT -->
        <div class="absolute inset-0 jr-hero-gradient"></div>


        <!-- PARTICLES -->
        <div id="jr-particles" class="absolute inset-0"></div>

        <!-- RED OVERLAY -->
        <div class="absolute inset-0 bg-black/30"></div>

        <!-- CONTENT -->
        <div class="relative z-10 min-h-screen max-w-7xl mx-auto px-5
               flex flex-col md:grid md:grid-cols-2
               items-center justify-center gap-14">

            <!-- TEXT -->
            <div class="text-center md:text-left text-white">
                <span class="inline-block mb-4 px-4 py-1 rounded-full
                bg-white/15 text-sm tracking-wide">
                    🔧 Trusted Repair Platform
                </span>

                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold leading-tight">
                    Repair Services <br>
                    <span class="text-white">That Come</span> <br>
                    <span class="text-gray-200">To Your Door</span>
                </h1>

                <p class="mt-6 text-gray-100 text-sm sm:text-base
                       max-w-md mx-auto md:mx-0">
                    AC, plumbing, electrical & appliance repair by verified
                    technicians — fast booking, fair pricing.
                </p>

                <!-- CTA -->
                <div class="mt-10 flex flex-col sm:flex-row gap-4
                justify-center md:justify-start">

                    <a href="#" class="bg-white text-[#8B0000] px-9 py-3 rounded-xl
                    font-bold shadow-2xl hover:scale-105 transition">
                        Book a Service
                    </a>

                    <a href="#services" class="border-2 border-white px-9 py-3 rounded-xl
                    font-semibold hover:bg-white hover:text-[#8B0000] transition">
                        Explore Services
                    </a>
                </div>
            </div>

            <!-- IMAGE CARD -->
            <div class="relative flex justify-center md:justify-end">
                <div class="absolute -inset-4 rounded-3xl
                bg-gradient-to-tr from-white/20 to-white/5 blur-2xl">
                </div>

                <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952" alt="Technician" class="relative w-full max-w-xs sm:max-w-sm md:max-w-md
                rounded-2xl shadow-[0_30px_80px_rgba(0,0,0,0.5)]
                animate-jr-float">
            </div>

        </div>
    </section>

    <!-- ================= HERO STYLES ================= -->

    <style>
        .jr-hero-gradient {
            background: linear-gradient(135deg,
                    #7a0000 0%,
                    #8B0000 45%,
                    #b11212 100%);
        }

        @keyframes jr-float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-16px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .animate-jr-float {
            animation: jr-float 4.5s ease-in-out infinite;
        }
    </style>

    <!-- ================= PARTICLES ================= -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        particlesJS("jr-particles", {
            particles: {
                number: { value: 80 },
                color: { value: "#ffffff" },
                shape: { type: "circle" },
                opacity: { value: 0.25 },
                size: { value: 3 },
                move: {
                    enable: true,
                    speed: 1.2
                }
            },
            interactivity: {
                events: {
                    onhover: { enable: true, mode: "repulse" },
                    onclick: { enable: true, mode: "push" }
                }
            },
            retina_detect: true
        });
    </script>

</div>