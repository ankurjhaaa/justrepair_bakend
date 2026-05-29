<section class=" pb-20">
    
    <!-- LOCAL SEO HERO BANNER -->
    <div class="bg-gradient-to-r from-red-600 to-red-800 text-white py-12 px-4 text-center sm:rounded-b-3xl shadow-lg mb-8">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-3">
                #1 Trusted Home Services in Purnea, Bihar
            </h1>
            <p class="text-red-100 text-lg">
                Fast, affordable, and expert repair services right at your doorstep in Purnea. Select a service below to book now!
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4">

        <!-- HEADER -->
        <div class="mb-8 text-center sm:text-left">
            <h2 class="text-2xl font-bold text-gray-900">
                Explore Our Services
            </h2>
            <p class="text-gray-500 text-sm mt-1">Professional technicians in Purnea & nearby areas</p>
        </div>

        <!-- SERVICES GRID -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">

            @foreach ($services as $service)
                    @php
                        $selected = in_array((string) $service->id, $selectedServices);
                    @endphp

                    <div wire:click="toggleService({{ $service->id }})" class="relative cursor-pointer bg-white rounded-2xl p-4 flex flex-col items-center text-center shadow-sm transition-all {{ $selected
                ? 'border-2 border-red-500 bg-red-50'
                : 'border border-gray-200 hover:border-primary' }}">

                        <!-- CHECK ICON -->
                        @if($selected)
                            <div
                                class="absolute top-2 right-2 w-6 h-6 rounded-full bg-red-500 text-white flex items-center justify-center text-xs">
                                ✓
                            </div>
                        @endif

                        <!-- ICON -->
                        <div class="w-14 h-14 flex items-center justify-center bg-gray-50 rounded-xl mb-3">
                            <img src="{{ $service->image_url }}" class="w-10 h-10 object-contain">
                        </div>

                        <!-- NAME -->
                        <span class="text-sm font-semibold text-gray-800">
                            {{ $service->name }}
                        </span>
                    </div>
            @endforeach

        </div>
    </div>

    <!-- AREAS WE SERVE IN PURNEA -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 border-t border-gray-100">
        <h3 class="text-xl font-bold text-gray-900 mb-6 text-center sm:text-left">Areas We Serve in Purnea District</h3>
        <p class="text-gray-600 mb-6 text-center sm:text-left max-w-4xl">
            We provide fast, reliable, and affordable home repair services across all major localities in Purnea. Need an electrician in Line Bazar? AC repair in Bhatta Bazar? Or plumbing in Madhubani? JustRepair has you covered!
        </p>
        <div class="flex flex-wrap gap-3 justify-center sm:justify-start">
            @php
                $localities = config('seo_cities.cities', []);
                // Filter out non-purnea cities from the main list if needed, or just display all.
                // We'll display all the purnea ones.
                $purneaLocalities = collect($localities)->filter(function($value, $key) {
                    return str_contains($key, 'purnea') && $key !== 'purnea';
                })->take(20);
                
                $firstService = \App\Models\Service::whereNotNull('slug')->first();
            @endphp
            @foreach($purneaLocalities as $key => $loc)
                <a wire:navigate href="{{ url('/' . $key . '/' . ($firstService->slug ?? '')) }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium border border-gray-200 hover:border-primary hover:text-primary transition">
                    <i class="fa-solid fa-location-dot text-primary mr-1"></i> {{ $loc }}
                </a>
            @endforeach
            <a wire:navigate href="{{ route('service') }}" class="bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-medium border border-primary/20 hover:bg-primary hover:text-white transition">
                Explore all areas &rarr;
            </a>
        </div>
    </div>

    <!-- BOTTOM BAR (LIKE APP) -->
    @if(count($selectedServices))

        <!-- MOBILE CTA -->
        <div class="fixed inset-x-0 bottom-20 px-4 z-50 md:hidden">
            <div class="bg-red-600 text-white rounded-xl shadow-xl
                                flex items-center justify-between px-5 py-4">

                <div class="flex items-center gap-2 text-sm font-semibold">
                    <span class="bg-white text-red-600 w-6 h-6 rounded-full
                                         flex items-center justify-center text-xs font-bold">
                        {{ count($selectedServices) }}
                    </span>
                    Services Selected
                </div>

                <button wire:click="goToBooking" class="font-semibold flex items-center gap-1">
                    Book Now →
                </button>
            </div>
        </div>

        <!-- DESKTOP CTA -->
        <div class="hidden md:block fixed bottom-6 left-1/2 -translate-x-1/2 z-40">
            <div class="bg-white border border-gray-200 shadow-lg rounded-md
                                px-6 py-4 flex items-center gap-8">

                <div>
                    <p class="text-xs text-gray-500">Selected Services</p>
                    <p class="text-lg font-bold text-gray-900">
                        {{ count($selectedServices) }}
                    </p>
                </div>

                <button wire:click="goToBooking" class="bg-red-600 text-white px-6 py-2.5
                                   rounded-md font-semibold hover:bg-red-700 transition">
                    Proceed to Booking →
                </button>
            </div>
        </div>

    @endif

</section>