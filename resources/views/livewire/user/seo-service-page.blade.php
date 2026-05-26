<div class="bg-gray-50 min-h-screen">
    
    <!-- ================= HERO SECTION ================= -->
    <section class="bg-white border-b relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-gradient-to-r from-primary to-primaryLight"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-16 text-center relative z-10">
            <h1 class="text-3xl sm:text-5xl font-extrabold text-gray-900 leading-tight">
                Top Rated <span class="text-primary">{{ $service->name }}</span> in {{ $city }}
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-600">
                Get the best, most reliable, and affordable {{ strtolower($service->name) }} services at your doorstep in {{ $city }}. Book our verified professionals today!
            </p>
            <div class="mt-8 flex justify-center gap-4">
                <a wire:navigate href="{{ route('booking', ['service' => $service->id]) }}" class="bg-primary text-white px-8 py-3 rounded-md font-bold text-lg hover:bg-primary/90 transition shadow-lg">
                    Book Now in {{ $city }}
                </a>
            </div>
        </div>
    </section>

    <!-- ================= WHY CHOOSE US ================= -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-12">
                Why choose us for {{ $service->name }} in {{ $city }}?
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 text-center">
                    <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-user-check text-2xl text-primary"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Verified Technicians</h3>
                    <p class="text-gray-600 text-sm">Every professional in {{ $city }} goes through strict background checks and quality training.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 text-center">
                    <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-tags text-2xl text-primary"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Affordable Pricing</h3>
                    <p class="text-gray-600 text-sm">We provide transparent and competitive pricing for all {{ strtolower($service->name) }} services.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 text-center">
                    <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-clock text-2xl text-primary"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">On-Time Service</h3>
                    <p class="text-gray-600 text-sm">We value your time. Our experts reach your location anywhere in {{ $city }} exactly on time.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= SERVICE DETAILS ================= -->
    <section class="py-16 bg-white border-t border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 flex flex-col md:flex-row gap-12 items-center">
            <div class="flex-1 text-center md:text-left">
                @if($service->image_url || $service->image)
                    <img src="{{ $service->image_url ?? asset('storage/' . $service->image) }}" alt="{{ $service->name }} in {{ $city }}" class="w-full h-auto max-w-md mx-auto md:mx-0 object-contain rounded-lg shadow-sm border border-gray-100 p-4">
                @else
                    <div class="w-full h-64 bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200">
                        <i class="fa-solid fa-screwdriver-wrench text-5xl text-gray-300"></i>
                    </div>
                @endif
            </div>
            <div class="flex-1">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6">Expert {{ $service->name }} Solutions</h2>
                <div class="prose prose-primary max-w-none text-gray-600">
                    <p class="mb-4">
                        Living in {{ $city }} means dealing with a busy lifestyle. When you need {{ strtolower($service->name) }}, you need it done fast and right the first time.
                    </p>
                    <p class="mb-6">
                        Our comprehensive {{ strtolower($service->name) }} services cover everything you need. Here's what's included:
                    </p>
                    <ul class="space-y-3 font-medium">
                        @if(is_array($service->requirements) && count($service->requirements) > 0)
                            @foreach($service->requirements as $req)
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-circle-check text-primary mt-1"></i>
                                    <span>{{ $req }}</span>
                                </li>
                            @endforeach
                        @else
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-primary mt-1"></i>
                                <span>Complete inspection and diagnosis</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-primary mt-1"></i>
                                <span>High-quality spare parts (if required)</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-primary mt-1"></i>
                                <span>Post-service cleanup</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= FAQS ================= -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6">
            <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-10">
                Frequently Asked Questions
            </h2>
            <div class="space-y-4">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900">How soon can a technician reach my home in {{ $city }}?</h3>
                    <p class="text-gray-600 mt-2">Depending on availability, our professionals can usually reach your location within a few hours of booking.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900">Is there a warranty on the {{ strtolower($service->name) }}?</h3>
                    <p class="text-gray-600 mt-2">Yes, we provide a service warranty. Any issues post-service are handled with priority.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900">Are there hidden charges?</h3>
                    <p class="text-gray-600 mt-2">No, our pricing is completely transparent. You will be informed of any extra material costs before the work begins.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= CTA ================= -->
    <section class="bg-primary py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center text-white">
            <h2 class="text-2xl sm:text-3xl font-bold">
                Ready to book {{ $service->name }} in {{ $city }}?
            </h2>
            <p class="mt-3 text-white/90">
                Join thousands of satisfied customers. Get started in minutes.
            </p>
            <a wire:navigate href="{{ route('booking', ['service' => $service->id]) }}" class="inline-block mt-8 bg-white text-primary px-10 py-4 rounded-md font-bold text-lg hover:bg-gray-100 transition shadow-lg">
                Book Service Now
            </a>
        </div>
    </section>
</div>
