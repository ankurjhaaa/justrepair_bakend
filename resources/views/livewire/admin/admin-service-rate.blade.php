<div x-data="{ mobileFilterOpen: false }" class="space-y-5 pb-20 md:pb-0">

    <!-- HEADER -->
    <div class="flex items-center justify-between min-h-[60px]">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Service Rates</h1>
            <p class="text-xs text-gray-500 mt-1">Manage pricing plans</p>
        </div>

        <div class="flex items-center gap-3">
            <!-- Desktop Add Button -->
            <button wire:click="create" class="hidden md:flex items-center gap-2 px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition-colors shadow-sm">
                <i class="fa-solid fa-plus"></i> <span>Add Rate</span>
            </button>
        </div>
    </div>

    <!-- RATES TABLE -->
    <div class="bg-white border border-gray-200 rounded-md overflow-x-auto">
        <table class="w-full text-sm text-left whitespace-nowrap text-gray-700">
            <thead class="bg-gray-50 text-gray-600 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 font-medium">Service</th>
                    <th class="px-4 py-3 font-medium">Title</th>
                    <th class="px-4 py-3 font-medium text-right">Price</th>
                    <th class="px-4 py-3 font-medium text-right">Duration</th>
                    <th class="px-4 py-3 font-medium text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($rates as $rate)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-[11px] font-medium bg-gray-100 text-gray-700 border border-gray-200">
                                {{ $rate->service->name }}
                            </span>
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900">
                            {{ $rate->title }}
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900 text-right">
                            ₹{{ number_format($rate->discount_price ?? $rate->price, 2) }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            {{ $rate->duration }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button wire:click="edit({{ $rate->id }})" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button wire:click="delete({{ $rate->id }})" class="p-1.5 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fa-solid fa-tag text-3xl mb-3 text-gray-300"></i>
                                <p class="text-sm">No service rates found</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MOBILE FLOATING ADD BUTTON -->
    <button wire:click="create" class="md:hidden fixed bottom-6 right-6 z-40 flex items-center justify-center w-14 h-14 bg-indigo-600 text-white rounded-full shadow-lg hover:bg-indigo-700 hover:scale-105 transition-transform">
        <i class="fa-solid fa-plus text-xl"></i>
    </button>

    <!-- MODAL -->
    <div x-show="$wire.showModal" class="relative z-50" x-cloak>
        <div x-show="$wire.showModal" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm" @click="$wire.showModal = false"></div>

        <div class="fixed inset-0 z-50 overflow-y-auto pointer-events-none">
            <div class="flex min-h-full items-end sm:items-center justify-center p-0 sm:p-4 text-center">
                <div x-show="$wire.showModal" 
                     x-transition:enter="transition ease-out duration-300" 
                     x-transition:enter-start="translate-y-full sm:opacity-0 sm:translate-y-4 sm:scale-95" 
                     x-transition:enter-end="translate-y-0 sm:opacity-100 sm:translate-y-0 sm:scale-100" 
                     x-transition:leave="transition ease-in duration-200" 
                     x-transition:leave-start="translate-y-0 sm:opacity-100 sm:translate-y-0 sm:scale-100" 
                     x-transition:leave-end="translate-y-full sm:opacity-0 sm:translate-y-4 sm:scale-95" 
                     class="pointer-events-auto relative transform overflow-hidden rounded-t-2xl sm:rounded-lg bg-white text-left shadow-2xl transition-all sm:my-8 w-full sm:max-w-md border-t sm:border border-gray-200 flex flex-col max-h-[90vh] sm:max-h-none">
                    <form wire:submit.prevent="save" class="flex flex-col h-full overflow-hidden">
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-gray-100 flex flex-col flex-1 min-h-0">
                            <div class="flex items-center justify-between mb-4 flex-shrink-0">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900">
                                    {{ $isEdit ? 'Edit Rate' : 'Add Rate' }}
                                </h3>
                                <button @click="$wire.showModal = false" type="button" class="text-gray-400 hover:text-gray-600">
                                    <i class="fa-solid fa-xmark text-lg"></i>
                                </button>
                            </div>
                            <div class="space-y-4 mt-2 overflow-y-auto pr-1 flex-1">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Service</label>
                                    <select wire:model="service_id" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                                        <option value="">Select Service</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Title</label>
                                    <input wire:model="title" placeholder="Title" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Duration</label>
                                    <input wire:model="duration" placeholder="Duration (eg: 30 mins)" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Price (₹)</label>
                                        <input wire:model="price" placeholder="0.00" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Discount Price (₹)</label>
                                        <input wire:model="discount_price" placeholder="0.00" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="block text-xs font-medium text-gray-700">Includes</label>
                                        <button type="button" wire:click="addInclude" class="text-xs font-semibold text-indigo-600 hover:text-indigo-500">
                                            + Add Include
                                        </button>
                                    </div>

                                    <div class="space-y-2">
                                        @foreach($includes as $i => $inc)
                                            <div class="flex gap-2 items-center">
                                                <input wire:model.defer="includes.{{ $i }}" placeholder="Include point" class="flex-1 h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                                                <button type="button" wire:click="removeInclude({{ $i }})" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 mt-auto">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 sm:ml-3 sm:w-auto">Save</button>
                            <button @click="$wire.showModal = false" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>