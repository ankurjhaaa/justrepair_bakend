<div class="bg-gray-50 min-h-screen overflow-x-hidden">

    <section class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 lg:grid-cols-3 gap-10">

            <!-- ================= LEFT ================= -->
            <div class="lg:col-span-2 space-y-12">

                <!-- STEP 1 : SERVICE -->
                <div>
                    <h2 class="font-bold text-lg mb-4">1. Select Service</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($services as $service)
                            @php $selected = in_array($service->id, $selectedServiceIds); @endphp

                            <div wire:click="toggleService({{ $service->id }})"
                                class="bg-white border rounded-lg p-4 cursor-pointer transition
                                                                                                                                                                                                                                                                {{ $selected ? 'border-primary ring-1 ring-primary' : 'hover:border-primary' }}">

                                <div class="flex items-center gap-4">
                                    <img src="{{ $service->image_url }}" class="w-12 h-12 object-contain">

                                    <div>
                                        <p class="font-semibold">{{ $service->name }}</p>
                                        <p class="text-sm {{ $selected ? 'text-primary' : 'text-gray-500' }}">
                                            {{ $selected ? 'Selected (tap to remove)' : 'Tap to select' }}
                                        </p>
                                    </div>
                                </div>
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
                                    class="bg-white border rounded-lg p-3 text-center cursor-pointer {{ $date === $d ? 'border-primary ring-1 ring-primary' : 'hover:border-primary' }}">
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
                                    class="bg-white border rounded-lg py-3 text-center cursor-pointer {{ $time === $slot ? 'border-primary ring-1 ring-primary' : 'hover:border-primary' }}">
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
                                <select wire:model.live="city" class="w-full border rounded-md px-4 py-3
                                                   @error('city') border-red-500 @enderror">

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
            <div class="">
                <div class="sticky top-24 bg-white rounded-xl p-6 shadow-sm">

                    <h3 class="font-bold text-lg mb-4">Booking Summary</h3>

                    <!-- SERVICES -->
                    <div class="text-sm mb-4">
                        <p class="font-semibold text-gray-700 mb-2">Services</p>

                        @if(count($selectedServiceIds))
                            <ul class="space-y-2">
                                @foreach($services->whereIn('id', $selectedServiceIds) as $service)
                                    <li class="border rounded-md p-2">
                                        <p class="font-medium text-gray-900">
                                            {{ $service->name }}
                                        </p>

                                        @if(!empty($allRequirements[$service->id] ?? []))
                                            <ul class="mt-1 ml-4 list-disc text-xs text-gray-600">
                                                @foreach($allRequirements[$service->id] as $req)
                                                    <li>{{ $req }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-xs text-gray-400 mt-1">
                                                No specific requirements
                                            </p>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-400">No service selected</p>
                        @endif
                    </div>

                    <!-- DATE & TIME -->
                    <div class="text-sm space-y-2 mb-4">
                        <p>Date: <b>{{ $date ?? 'No date selected' }}</b></p>
                        <p>Time: <b>{{ $time ?? 'No time selected' }}</b></p>
                    </div>

                    <!-- CONFIRM BUTTON -->
                    <button wire:click="bookService" {{ ($step < 4 || empty($selectedServiceIds)) || $name == null || $mobile == null || $city == null || $address == null ? 'disabled' : '' }} class="w-full py-3 rounded-md font-semibold transition
            {{ ($step < 4 || empty($selectedServiceIds)) || $name == null || $mobile == null || $city == null || $address == null
    ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
    : 'bg-primary text-white hover:bg-primary/90' }}">
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