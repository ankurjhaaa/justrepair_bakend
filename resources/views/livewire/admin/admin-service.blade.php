<div class="">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Services</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage all service offerings</p>
        </div>

        <button wire:click="create"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg
                   bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700">
            <i class="fa-solid fa-plus"></i>
            Add Service
        </button>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 rounded-md shadow overflow-x-auto mt-6">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3 text-left">Service</th>
                    <th class="px-4 py-3 text-left">Image</th>
                    <th class="px-4 py-3 text-left">Requirements</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($services as $service)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40">
                        <td class="px-4 py-3">
                            <p class="font-medium text-gray-800 dark:text-gray-100">
                                {{ $service->name }}
                            </p>
                            <p class="text-xs text-gray-500">{{ $service->slug }}</p>
                        </td>

                        <td class="px-4 py-3">
                            @if($service->image)
                                <img src="{{ $service->image_url }}"
                                    class="w-12 h-12 rounded-lg object-cover border">
                            @else
                                <span class="text-xs text-gray-400">No image</span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($service->requirements ?? [] as $req)
                                    <span class="px-2 py-0.5 text-xs rounded-full
                                        bg-indigo-50 text-indigo-700
                                        dark:bg-indigo-900/40 dark:text-indigo-300">
                                        {{ $req }}
                                    </span>
                                @endforeach
                            </div>
                        </td>

                        <td class="px-4 py-3 text-right space-x-2">
                            <button wire:click="edit({{ $service->id }})"
                                class="px-3 py-1.5 text-xs rounded-md
                                       bg-blue-100 text-blue-700
                                       dark:bg-blue-900/40 dark:text-blue-300">
                                Edit
                            </button>

                            <button wire:click="delete({{ $service->id }})"
                                class="px-3 py-1.5 text-xs rounded-md
                                       bg-red-100 text-red-600
                                       dark:bg-red-900/40 dark:text-red-300">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            No services added yet
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center px-3">

            <div class="bg-white dark:bg-gray-800 w-full max-w-lg rounded-md shadow-xl
                        max-h-[90vh] flex flex-col">

                <!-- Modal Header -->
                <div class="px-5 py-4 border-b dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                        {{ $isEdit ? 'Edit Service' : 'Add Service' }}
                    </h2>
                </div>

                <!-- Modal Body -->
                <div class="p-5 space-y-4 overflow-y-auto">

                    <!-- Name -->
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Service Name
                        </label>
                        <input type="text" wire:model.defer="name"
                            class="w-full h-11 mt-1 px-3 rounded-md border
                                   bg-white dark:bg-gray-900
                                   text-gray-800 dark:text-gray-100
                                   placeholder-gray-400 dark:placeholder-gray-500
                                   focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- Image -->
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Service Image
                        </label>
                        <input type="file" wire:model="image" accept="image/*"
                            class="w-full h-11 py-2 px-3 rounded-md border
                                   bg-white dark:bg-gray-900
                                   text-gray-800 dark:text-gray-100 cursor-pointer">

                        <div wire:loading wire:target="image"
                            class="text-xs text-gray-500 mt-1">
                            Uploading...
                        </div>

                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}"
                                class="mt-3 h-24 rounded-md border object-cover">
                        @elseif($existingImageUrl)
                            <img src="{{ $existingImageUrl }}"
                                class="mt-3 h-24 rounded-md border object-cover">
                        @endif
                    </div>

                    <!-- Requirements -->
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Requirements
                        </label>

                        <div class="space-y-2 mt-2">
                            @foreach($requirements as $index => $req)
                                <div class="flex gap-2">
                                    <input type="text"
                                        wire:model.defer="requirements.{{ $index }}"
                                        placeholder="Enter requirement"
                                        class="flex-1 h-10 px-3 rounded-md border
                                               bg-white dark:bg-gray-900
                                               text-gray-800 dark:text-gray-100
                                               placeholder-gray-400 dark:placeholder-gray-500">

                                    <button type="button"
                                        wire:click="removeRequirement({{ $index }})"
                                        class="w-10 h-10 rounded-md
                                               bg-red-100 text-red-600
                                               dark:bg-red-900/40 dark:text-red-300">
                                        ✕
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <button wire:click="addRequirement"
                            class="mt-3 text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                            + Add Requirement
                        </button>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="px-5 py-4 border-t dark:border-gray-700 flex justify-end gap-2">
                    <button wire:click="$set('showModal', false)"
                        class="px-4 py-2 rounded-md border
                               text-gray-700 dark:text-gray-300">
                        Cancel
                    </button>

                    <button wire:click="save"
                        class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">
                        Save
                    </button>
                </div>

            </div>
        </div>
    @endif

</div>
