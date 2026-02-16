<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">Services</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage your service offerings</p>
        </div>

        <button wire:click="create"
            class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-sm transition-all active:scale-95 w-full sm:w-auto">
            <i class="fa-solid fa-plus"></i>
            <span>Add Service</span>
        </button>
    </div>

    <!-- CONTENT: Desktop Table & Mobile Cards -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        
        <!-- Desktop Table (Hidden on small screens) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 uppercase tracking-wider text-xs border-b border-gray-100 dark:border-gray-700">
                        <th class="px-6 py-4 font-semibold">Service Info</th>
                        <th class="px-6 py-4 font-semibold">Requirements</th>
                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($services as $service)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="h-12 w-12 flex-shrink-0 rounded-lg bg-gray-100 dark:bg-gray-700 overflow-hidden border border-gray-200 dark:border-gray-600">
                                        @if($service->image)
                                            <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-gray-400">
                                                <i class="fa-regular fa-image text-lg"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900 dark:text-white">{{ $service->name }}</h3>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2 max-w-md">
                                    @forelse($service->requirements ?? [] as $req)
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-indigo-50 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300 border border-indigo-100 dark:border-indigo-800">
                                            {{ $req }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-gray-400 italic">No specific requirements</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="edit({{ $service->id }})" 
                                        class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg dark:text-indigo-400 dark:hover:bg-indigo-900/30 transition">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button wire:click="delete({{ $service->id }})" 
                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg dark:text-red-400 dark:hover:bg-red-900/30 transition">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                         <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="h-16 w-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                        <i class="fa-solid fa-layer-group text-2xl text-gray-400"></i>
                                    </div>
                                    <p class="text-lg font-medium text-gray-900 dark:text-white">No services found</p>
                                    <p class="text-sm mt-1">Get started by creating a new service.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards (Visible on small screens) -->
        <div class="md:hidden divide-y divide-gray-100 dark:divide-gray-700">
            @forelse($services as $service)
                <div class="p-4 space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="h-14 w-14 flex-shrink-0 rounded-lg bg-gray-100 dark:bg-gray-700 overflow-hidden border border-gray-200 dark:border-gray-600">
                             @if($service->image)
                                <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full flex items-center justify-center text-gray-400">
                                    <i class="fa-regular fa-image text-xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white truncate">{{ $service->name }}</h3>
                             <div class="flex items-center gap-3 mt-1">
                                <button wire:click="edit({{ $service->id }})" class="text-xs font-medium text-indigo-600 dark:text-indigo-400 hover:underline">Edit</button>
                                <span class="text-gray-300 dark:text-gray-600">|</span>
                                <button wire:click="delete({{ $service->id }})" class="text-xs font-medium text-red-600 dark:text-red-400 hover:underline">Delete</button>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Requirements Scroll -->
                    @if(count($service->requirements ?? []) > 0)
                        <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-1">
                             @foreach($service->requirements as $req)
                                <span class="flex-shrink-0 inline-flex items-center px-2 py-1 rounded text-[10px] font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 whitespace-nowrap border border-gray-200 dark:border-gray-600">
                                    {{ $req }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div class="p-8 text-center text-gray-500 dark:text-gray-400">
                    <p>No services found.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                <!-- Backdrop -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" wire:click="$set('showModal', false)"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Modal Panel -->
                <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">

                    <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                            {{ $isEdit ? 'Edit Service' : 'Add New Service' }}
                        </h3>
                    </div>

                    <div class="px-4 py-5 sm:p-6 space-y-5">
                         <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Service Name</label>
                            <input type="text" wire:model.defer="name" placeholder="e.g. AC Repair"
                                class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
                            @error('name') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Image -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Service Icon/Image</label>

                            <div class="mt-1 flex items-center gap-4">
                                <div class="h-16 w-16 rounded-lg border border-gray-300 dark:border-gray-600 overflow-hidden bg-gray-50 dark:bg-gray-900 flex items-center justify-center">
                                     @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" class="h-full w-full object-cover">
                                    @elseif($existingImageUrl)
                                        <img src="{{ $existingImageUrl }}" class="h-full w-full object-cover">
                                    @else
                                        <i class="fa-regular fa-image text-gray-400"></i>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input type="file" wire:model="image" accept="image/*"
                                        class="block w-full text-sm text-gray-500 dark:text-gray-400
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-xs file:font-semibold
                                        file:bg-indigo-50 file:text-indigo-700
                                        hover:file:bg-indigo-100
                                        dark:file:bg-indigo-900/40 dark:file:text-indigo-300
                                    "/>
                                    <div wire:loading wire:target="image" class="text-xs text-indigo-500 mt-1">Uploading...</div>
                                </div>
                            </div>
                             @error('image') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Requirements -->
                        <div>
                             <div class="flex items-center justify-between mb-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Requirements / Checklist</label>
                                <button type="button" wire:click="addRequirement" class="text-xs font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">
                                    + Add Item
                                </button>
                            </div>

                            <div class="space-y-2 max-h-48 overflow-y-auto pr-1">
                                @foreach($requirements as $index => $req)
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-400 text-xs">{{ $loop->iteration }}.</span>
                                        <input type="text"
                                            wire:model.defer="requirements.{{ $index }}"
                                            placeholder="Requirement details"
                                            class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-xs px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
                                        <button type="button" wire:click="removeRequirement({{ $index }})" class="text-gray-400 hover:text-red-500 transition">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700/30 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100 dark:border-gray-700">
                        <button type="button" wire:click="save" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Save Service
                        </button>
                        <button type="button" wire:click="$set('showModal', false)" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endif

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
