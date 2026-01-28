<div class="bg-gray-50 min-h-screen overflow-x-hidden">

    <section class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 lg:grid-cols-3 gap-10 lg:items-start">

            <!-- ================= LEFT ================= -->
            <div class="lg:col-span-2 space-y-12">

                <!-- STEP 1 : SERVICE -->
                <div>
                    <h2 class="font-bold text-lg mb-4">1. Select Service</h2>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 sm:gap-6">
                        @foreach($services as $service)
                            @php
                                $selected = in_array($service->id, $selectedServiceIds);
                            @endphp

                            <div wire:click="toggleService({{ $service->id }})"
                                class="relative group cursor-pointer rounded-2xl p-4 sm:p-6 flex flex-col items-center justify-center text-center select-none transition-all duration-200 active:scale-95 {{ $selected ? 'bg-red-50 border-2 border-primary shadow-md' : 'bg-white border hover:border-primary hover:shadow-lg' }}"
                                style="-webkit-tap-highlight-color: transparent;">

                                <!-- CHECK ICON (SELECTED) -->
                                @if($selected)
                                    <div
                                        class="absolute top-3 right-3 w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">
                                        ✓
                                    </div>
                                @endif

                                <!-- ICON -->
                                <div
                                    class="w-14 h-14 sm:w-16 sm:h-16 flex items-center justify-center rounded-xl mb-3 {{ $selected ? 'bg-primary/10' : 'bg-gray-50' }}">
                                    <img src="{{ $service->image_url }}" alt="{{ $service->name }}"
                                        class="w-10 h-10 sm:w-12 sm:h-12 object-contain">
                                </div>

                                <!-- NAME -->
                                <p
                                    class="text-sm sm:text-base font-semibold {{ $selected ? 'text-primary' : 'text-gray-800' }}">
                                    {{ $service->name }}
                                </p>

                                <!-- SUBTEXT -->
                                <p class="text-xs mt-1 {{ $selected ? 'text-primary' : 'text-gray-500' }}">
                                    {{ $selected ? 'Selected' : 'Tap to select' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>


                <!-- STEP 2 : DATE -->
                @if($step >= 2)
                    <div>
                        <h2 class="font-bold text-lg mb-4">2. Select Date</h2>
                        <div class="grid grid-cols-3 sm:grid-cols-5 gap-3">
                            @for($i = 0; $i < 5; $i++)
                                @php $d = now()->addDays($i)->toDateString(); @endphp
                                <div wire:click="selectDate('{{ $d }}')"
                                    class="select-none bg-white border rounded-lg p-3 text-center cursor-pointer transition active:scale-95 {{ $date === $d ? 'border-primary ring-1 ring-primary' : 'hover:border-primary' }}"
                                    style="-webkit-tap-highlight-color: transparent;">

                                    <p class="text-xs">{{ now()->addDays($i)->format('D') }}</p>
                                    <p class="text-lg font-bold text-primary">{{ now()->addDays($i)->format('d') }}</p>
                                    <p class="text-xs">{{ now()->addDays($i)->format('M') }}</p>
                                </div>

                            @endfor
                        </div>
                    </div>
                @endif

                <!-- STEP 3 : TIME -->
                @if($step >= 3)
                    <div>
                        <h2 class="font-bold text-lg mb-4">3. Select Time</h2>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach(['9:00 AM - 12:00 PM', '12:00 PM - 03:00 PM', '03:00 PM - 06:00 PM', '06:00 PM - 09:00 PM'] as $slot)

                                <div wire:click="selectTime('{{ $slot }}')"
                                    class="select-none bg-white border rounded-lg py-3 text-center cursor-pointer transition active:scale-95 {{ $time === $slot ? 'border-primary ring-1 ring-primary bg-primary/5' : 'hover:border-primary' }}"
                                    style="-webkit-tap-highlight-color: transparent;">

                                    {{ $slot }}
                                </div>

                            @endforeach
                        </div>
                    </div>
                @endif


                <!-- STEP 4 : ADDRESS -->
                @if($step >= 4)
                    <div>
                        <h2 class="font-bold text-lg mb-4">4. Address</h2>

                        <!-- NAME -->
                        <div class="mb-3">
                            <input wire:model.live="name" placeholder="Name"
                                class="w-full border rounded-md px-4 py-3 @error('name') border-red-500 @enderror">

                            @error('name')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- MOBILE WITH +91 -->
                        <div class="mb-3">
                            <div class="flex border rounded-md @error('mobile') border-red-500 @enderror">

                                <!-- PREFIX -->
                                <span class="px-4 flex items-center bg-gray-100 text-gray-600 text-sm rounded-s-md">
                                    +91
                                </span>

                                <!-- INPUT -->
                                <input wire:model.live="mobile" type="tel" inputmode="numeric" maxlength="10"
                                    pattern="[0-9]*" placeholder="Enter 10 digit mobile"
                                    class="w-full px-4 py-3 outline-none rounded-r-md">
                            </div>

                            @error('mobile')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-3 mb-3">

                            <!-- STATE (FIXED : BIHAR) -->
                            <div>
                                <select disabled
                                    class="w-full border rounded-md px-4 py-3 bg-gray-100 text-gray-600 cursor-not-allowed">
                                    <option selected>Bihar</option>
                                </select>
                            </div>

                            <!-- CITY -->
                            <div>
                                <select wire:model.live="city"
                                    class="w-full border rounded-md px-4 py-3 @error('city') border-red-500 @enderror">

                                    <option value="">Select City</option>
                                    <option value="Purnea">Purnea</option>
                                    <option value="Patna">Patna</option>
                                </select>

                                @error('city')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>


                        <!-- LANDMARK -->
                        <div class="mb-3">
                            <input wire:model.live="landmark" placeholder="Landmark (optional)"
                                class="w-full border rounded-md px-4 py-3 @error('landmark') border-red-500 @enderror">

                            @error('landmark')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ADDRESS -->
                        <div>
                            <textarea wire:model.live="address" placeholder="Full Address" rows="3"
                                class="w-full border rounded-md px-4 py-3 @error('address') border-red-500 @enderror"></textarea>

                            @error('address')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @endif



            </div>

            <!-- ================= RIGHT SUMMARY ================= -->
            <div class="lg:sticky lg:top-20 self-start mb-10">
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">

                    <!-- Header -->
                    <h3 class="font-bold text-xl mb-5 text-gray-900 flex items-center gap-2">
                        Booking Summary
                    </h3>

                    <!-- SERVICES -->
                    <div class="text-sm mb-5">
                        <p class="font-semibold text-gray-700 mb-3">Selected Services</p>

                        @if(count($selectedServiceIds))
                            <ul class="space-y-3">
                                @foreach($services->whereIn('id', $selectedServiceIds) as $service)
                                    <li class="rounded-lg border p-3 bg-gray-50">

                                        <p class="font-medium text-gray-900">
                                            {{ $service->name }}
                                        </p>

                                        @if(!empty($allRequirements[$service->id] ?? []))
                                            <ul class="mt-2 ml-4 list-disc text-xs text-gray-600">
                                                @foreach($allRequirements[$service->id] as $req)
                                                    <li>{{ $req }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-xs text-gray-400 mt-2 italic">
                                                No specific requirements
                                            </p>
                                        @endif

                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-400 italic">No service selected</p>
                        @endif
                    </div>

                    <!-- DATE & TIME -->
                    <div class="text-sm mb-5 space-y-2 border-t pt-4">
                        <p class="flex justify-between">
                            <span class="text-gray-600">Date</span>
                            <span class="font-semibold text-gray-900">
                                {{ $date ?? '—' }}
                            </span>
                        </p>
                        <p class="flex justify-between">
                            <span class="text-gray-600">Time</span>
                            <span class="font-semibold text-gray-900">
                                {{ $time ?? '—' }}
                            </span>
                        </p>
                    </div>

                    <!-- CONFIRM BUTTON -->
                    <button wire:click="bookService" {{ ($step < 4 || empty($selectedServiceIds)) || !$name || !$mobile || !$city || !$address ? 'disabled' : '' }} class="w-full py-3 rounded-xl font-semibold text-base transition
            {{ ($step < 4 || empty($selectedServiceIds)) || !$name || !$mobile || !$city || !$address
    ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
    : 'bg-primary text-white hover:bg-primary/90 active:scale-95' }}">

                        Confirm Booking
                    </button>

                </div>
            </div>



        </div>
    </section>

    <!-- ================= SERVICE MODAL ================= -->
    @if($showServiceModal)
        <div class="fixed inset-0 z-[999] bg-black/40 flex items-end sm:items-center justify-center">
            <div class="bg-white w-full sm:max-w-md rounded-t-md sm:rounded-md p-6">

                <h3 class="font-bold text-lg">{{ $activeService->name }}</h3>
                <p class="text-sm text-gray-500 mt-1">Select requirements</p>

                <div class="mt-4 space-y-3">
                    @foreach($selectedServiceRequirements as $req)
                        <label class="flex gap-3 text-sm cursor-pointer">
                            <input type="checkbox" class="" wire:model="selectedRequirements" value="{{ $req }}">
                            {{ $req }}
                        </label>
                    @endforeach
                </div>

                <div class="mt-6 flex gap-3">
                    <button wire:click="confirmService" class="flex-1 bg-primary text-white py-2 rounded-md">
                        OK
                    </button>
                    <button wire:click="cancelService" class="flex-1 border py-2 rounded-md">
                        Cancel
                    </button>
                </div>

            </div>
        </div>
    @endif


</div>