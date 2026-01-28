<div class="bg-gray-50 min-h-screen overflow-x-hidden">

    <!-- ================= HEADER ================= -->
    <section class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 text-center">

            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900">
                Our <span class="text-primary">Services</span>
            </h1>

            <p class="mt-4 max-w-2xl mx-auto text-gray-600">
                Choose from a wide range of professional home repair services.
            </p>

        </div>
    </section>

    <!-- ================= SERVICES GRID ================= -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            @if($services->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach($services as $service)
                        <div class="bg-white rounded-md p-6 shadow-sm hover:shadow-md transition flex flex-col">

                            <!-- ICON / IMAGE -->
                            <div class="flex items-center gap-4">
                                <img src="{{ $service->image_url ?? asset('placeholder.png') }}" alt="{{ $service->name }}"
                                    class="w-14 h-14 object-contain" />

                                <h3 class="text-lg font-bold text-gray-900">
                                    {{ $service->name }}
                                </h3>
                            </div>

                            <!-- DESCRIPTION -->
                            <p class="mt-4 text-sm text-gray-600 leading-relaxed flex-1">
                                {{ Str::limit($service->requirements[0] ?? 'Professional service available.', 100) }}
                            </p>

                            <!-- ACTION -->
                            <a wire:navigate href="{{ route('booking', ['service' => $service->id]) }}"
                                class="mt-6 inline-block text-primary font-semibold text-sm hover:underline">
                                Book Service →
                            </a>
                        </div>
                    @endforeach

                </div>
            @else
                <div class="text-center text-gray-500">
                    No services available right now.
                </div>
            @endif

        </div>
    </section>

    <!-- ================= CTA ================= -->
    <section class="bg-primary py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center text-white">

            <h2 class="text-2xl sm:text-3xl font-bold">
                Need a Service Right Now?
            </h2>

            <p class="mt-3 text-white/90">
                Book trusted professionals in just a few clicks.
            </p>

            <a href="#" class="inline-block mt-6 bg-white text-primary px-8 py-3
                      rounded-md font-semibold hover:bg-gray-100 transition">
                Book a Service
            </a>

        </div>
    </section>

</div>