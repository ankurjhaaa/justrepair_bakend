<div class="overflow-x-hidden">

    {{-- HERO --}}
    <livewire:user.component.home-hero />

    <!-- ================= SERVICES ================= -->
    <section id="services" class="bg-gray-50 py-20 sm:py-28 overflow-x-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            <h2 class="text-3xl sm:text-4xl font-extrabold text-center text-gray-900">
                Our <span class="text-primary">Services</span>
            </h2>

            <p class="mt-4 text-center text-gray-600 max-w-2xl mx-auto">
                Premium home repair services by verified professionals.
            </p>

            <!-- SERVICES LIST -->
            <div class="mt-16 sm:mt-20 space-y-16 sm:space-y-20">

                @foreach ($services as $index => $service)
                    <div class="service-row
                                        {{ $index % 2 === 0 ? 'from-left' : 'from-right' }}
                                        flex flex-col
                                        md:flex-row {{ $index % 2 ? 'md:flex-row-reverse' : '' }}
                                        items-stretch md:items-center
                                        gap-8 sm:gap-10 md:gap-16">

                        <!-- CARD -->
                        <div class="w-full md:w-1/2
                                                   bg-white rounded-2xl
                                                   p-6 sm:p-8 md:p-10
                                                   shadow-xl
                                                   flex flex-col justify-between">

                            <div class="flex items-center gap-4 sm:gap-5">
                                <img src="{{ $service->image_url ?? asset('placeholder.png') }}" alt="{{ $service->name }}"
                                    class="w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 object-contain" />

                                <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-primary">
                                    {{ $service->name }}
                                </h3>
                            </div>

                            <p class="mt-4 sm:mt-6 text-gray-600 text-sm sm:text-base md:text-lg leading-relaxed">
                                {{ Str::limit($service->requirements[0] ?? 'Professional repair service available.', 120) }}
                            </p>

                            <a href="#" class="mt-6 sm:mt-8 inline-block w-fit
                                                      text-sm sm:text-base font-semibold text-primary
                                                      hover:underline">
                                Book this service →
                            </a>
                        </div>

                        <!-- EMPTY SPACE (DESKTOP ONLY) -->
                        <div class="hidden md:block md:w-1/2"></div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- ================= ANIMATION ================= -->
    <style>
        .service-row {
            opacity: 0;
            transition:
                opacity 1s cubic-bezier(0.22, 1, 0.36, 1),
                transform 1s cubic-bezier(0.22, 1, 0.36, 1);
            will-change: transform;
        }

        /* Desktop animation */
        @media (min-width: 768px) {
            .service-row.from-left {
                transform: translateX(-120px);
            }

            .service-row.from-right {
                transform: translateX(120px);
            }
        }

        /* Mobile animation — SAME LEFT/RIGHT but SAFE */
        @media (max-width: 767px) {
            .service-row.from-left {
                transform: translateX(-24px);
            }

            .service-row.from-right {
                transform: translateX(24px);
            }
        }

        .service-row.show {
            opacity: 1;
            transform: translateX(0);
        }
    </style>


    <!-- ================= JS ================= -->
    <script>
        function initServiceAnimation() {
            const rows = document.querySelectorAll('.service-row');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('show');
                    }
                });
            }, {
                threshold: 0.35
            });

            rows.forEach(row => observer.observe(row));
        }

        document.addEventListener('DOMContentLoaded', initServiceAnimation);
        document.addEventListener('livewire:navigated', initServiceAnimation);
    </script>

</div>