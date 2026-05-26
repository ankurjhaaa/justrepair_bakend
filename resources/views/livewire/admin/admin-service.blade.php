<div x-data="{ mobileFilterOpen: false }" class="space-y-5 pb-20 md:pb-0">

    <!-- HEADER -->
    <div class="flex items-center justify-between min-h-[60px]">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Services</h1>
            <p class="text-xs text-gray-500 mt-1">Manage your service offerings</p>
        </div>

        <div class="flex items-center gap-3">
            <!-- Desktop Add Button -->
            <button wire:click="create" class="hidden md:flex items-center gap-2 px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition-colors shadow-sm">
                <i class="fa-solid fa-plus"></i> <span>Add Service</span>
            </button>
        </div>
    </div>

    <!-- CONTENT: Desktop Table & Mobile Cards -->
    <div class="bg-white border border-gray-200 rounded-md overflow-hidden">
        
        <!-- Desktop Table (Hidden on small screens) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap text-gray-700">
                <thead class="bg-gray-50 text-gray-600 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 font-medium">Service Info</th>
                        <th class="px-4 py-3 font-medium">Requirements</th>
                        <th class="px-4 py-3 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($services as $service)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 flex-shrink-0 rounded-md bg-gray-50 overflow-hidden border border-gray-200">
                                        @if($service->image)
                                            <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-gray-400">
                                                <i class="fa-regular fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <h3 class="font-medium text-gray-900">{{ $service->name }}</h3>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-1.5 max-w-md">
                                    @forelse($service->requirements ?? [] as $req)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-medium bg-gray-100 text-gray-700 border border-gray-200">
                                            {{ $req }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-gray-400 italic">No specific requirements</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="edit({{ $service->id }})" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button wire:click="delete({{ $service->id }})" class="p-1.5 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                         <tr>
                            <td colspan="3" class="px-4 py-10 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fa-solid fa-layer-group text-3xl mb-3 text-gray-300"></i>
                                    <p class="text-sm">No services found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards (Visible on small screens) -->
        <div class="md:hidden divide-y divide-gray-100">
            @forelse($services as $service)
                <div class="p-4 space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="h-12 w-12 flex-shrink-0 rounded-md bg-gray-50 overflow-hidden border border-gray-200">
                             @if($service->image)
                                <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full flex items-center justify-center text-gray-400">
                                    <i class="fa-regular fa-image"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-semibold text-gray-900 truncate">{{ $service->name }}</h3>
                             <div class="flex items-center gap-2 mt-1">
                                <button wire:click="edit({{ $service->id }})" class="text-xs font-medium text-indigo-600 hover:underline">Edit</button>
                                <span class="text-gray-300">|</span>
                                <button wire:click="delete({{ $service->id }})" class="text-xs font-medium text-red-600 hover:underline">Delete</button>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Requirements Scroll -->
                    @if(count($service->requirements ?? []) > 0)
                        <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar pb-1">
                             @foreach($service->requirements as $req)
                                <span class="flex-shrink-0 inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-medium bg-gray-100 text-gray-700 whitespace-nowrap border border-gray-200">
                                    {{ $req }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div class="p-8 text-center text-gray-500">
                    <p class="text-sm">No services found.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- MOBILE FLOATING ADD BUTTON -->
    <button wire:click="create" class="md:hidden fixed bottom-24 right-6 z-40 flex items-center justify-center w-14 h-14 bg-indigo-600 text-white rounded-full shadow-lg hover:bg-indigo-700 hover:scale-105 transition-transform">
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
                                    {{ $isEdit ? 'Edit Service' : 'Add Service' }}
                                </h3>
                                <button @click="$wire.showModal = false" type="button" class="text-gray-400 hover:text-gray-600">
                                    <i class="fa-solid fa-xmark text-lg"></i>
                                </button>
                            </div>
                            
                            <div class="space-y-4 mt-2 overflow-y-auto pr-1 flex-1">
                                <!-- Name -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Service Name</label>
                                    <input type="text" wire:model.defer="name" placeholder="e.g. AC Repair" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                                    @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Image -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Service Icon/Image</label>
                                    <div class="flex items-center gap-3">
                                        <div class="h-14 w-14 rounded-md border border-gray-200 overflow-hidden bg-gray-50 flex items-center justify-center flex-shrink-0">
                                             @if ($image)
                                                <img src="{{ $image->temporaryUrl() }}" class="h-full w-full object-cover">
                                            @elseif($existingImageUrl)
                                                <img src="{{ $existingImageUrl }}" class="h-full w-full object-cover">
                                            @else
                                                <i class="fa-regular fa-image text-gray-400 text-lg"></i>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <input type="file" wire:model="image" accept="image/*"
                                                class="block w-full text-xs text-gray-500
                                                file:mr-3 file:py-1.5 file:px-3
                                                file:rounded-md file:border-0
                                                file:text-xs file:font-medium
                                                file:bg-indigo-50 file:text-indigo-700
                                                hover:file:bg-indigo-100 transition-colors
                                            "/>
                                            <div wire:loading wire:target="image" class="text-xs text-indigo-500 mt-1">Uploading...</div>
                                        </div>
                                    </div>
                                     @error('image') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Requirements -->
                                <div>
                                     <div class="flex items-center justify-between mb-2">
                                        <label class="block text-xs font-medium text-gray-700">Requirements / Checklist</label>
                                        <button type="button" wire:click="addRequirement" class="text-xs font-semibold text-indigo-600 hover:text-indigo-500">
                                            + Add Item
                                        </button>
                                    </div>

                                    <div class="space-y-2">
                                        @foreach($requirements as $index => $req)
                                            <div class="flex items-center gap-2">
                                                <span class="text-gray-400 text-xs w-4 text-right">{{ $loop->iteration }}.</span>
                                                <input type="text"
                                                    wire:model.defer="requirements.{{ $index }}"
                                                    placeholder="Requirement details"
                                                    class="flex-1 h-9 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                                                <button type="button" wire:click="removeRequirement({{ $index }})" class="p-1.5 text-gray-400 hover:text-red-500 transition-colors">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 mt-auto">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 sm:ml-3 sm:w-auto">Save Service</button>
                            <button type="button" @click="$wire.showModal = false" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</div>
