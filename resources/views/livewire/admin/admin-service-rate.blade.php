<div class="">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Service Rates
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Manage pricing plans
            </p>
        </div>

        <button wire:click="create" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg
                   bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700">
            + Add Rate
        </button>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 rounded-md shadow overflow-x-auto mt-6">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3 text-left">Service</th>
                    <th class="px-4 py-3 text-left">Title</th>
                    <th class="px-4 py-3 text-left">Price</th>
                    <th class="px-4 py-3 text-left">Duration</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($rates as $rate)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40">
                        <td class="px-4 py-3">
                            {{ $rate->service->name }}
                        </td>

                        <td class="px-4 py-3 font-medium">
                            {{ $rate->title }}
                        </td>

                        <td class="px-4 py-3">
                            ₹{{ $rate->discount_price ?? $rate->price }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $rate->duration }}
                        </td>

                        <td class="px-4 py-3 text-right space-x-2">
                            <button wire:click="edit({{ $rate->id }})" class="text-xs px-3 py-1.5 rounded-md
                                                   bg-blue-100 text-blue-700
                                                   dark:bg-blue-900/40 dark:text-blue-300">
                                Edit
                            </button>

                            <button wire:click="delete({{ $rate->id }})" class="text-xs px-3 py-1.5 rounded-md
                                                   bg-red-100 text-red-600
                                                   dark:bg-red-900/40 dark:text-red-300">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            No service rates found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center px-3">

            <div class="bg-white dark:bg-gray-800
                                    w-full max-w-lg rounded-xl shadow-xl
                                    max-h-[90vh] flex flex-col">

                <!-- Header -->
                <div class="px-5 py-4 border-b dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                        {{ $isEdit ? 'Edit Rate' : 'Add Rate' }}
                    </h2>
                </div>

                <!-- Scrollable Body -->
                <div class="p-5 space-y-4 overflow-y-auto">

                    <!-- Service -->
                    <select wire:model="service_id" class="w-full h-11 px-3 rounded-md border
                                           bg-white dark:bg-gray-900
                                           text-gray-800 dark:text-gray-100">
                        <option value="">Select Service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Title -->
                    <input wire:model="title" placeholder="Title" class="w-full h-11 px-3 rounded-md border
                                           bg-white dark:bg-gray-900
                                           text-gray-800 dark:text-gray-100
                                           placeholder-gray-400 dark:placeholder-gray-500">

                    <!-- Duration -->
                    <input wire:model="duration" placeholder="Duration (eg: 30 mins)" class="w-full h-11 px-3 rounded-md border
                                           bg-white dark:bg-gray-900
                                           text-gray-800 dark:text-gray-100
                                           placeholder-gray-400 dark:placeholder-gray-500">

                    <!-- Prices -->
                    <div class="grid grid-cols-2 gap-3">
                        <input wire:model="price" placeholder="Price" class="h-11 px-3 rounded-md border
                                               bg-white dark:bg-gray-900
                                               text-gray-800 dark:text-gray-100">

                        <input wire:model="discount_price" placeholder="Discount Price" class="h-11 px-3 rounded-md border
                                               bg-white dark:bg-gray-900
                                               text-gray-800 dark:text-gray-100">
                    </div>

                    <!-- Includes -->
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Includes
                        </label>

                        <div class="space-y-2 mt-2">
                            @foreach($includes as $i => $inc)
                                <div class="flex gap-2">
                                    <input wire:model.defer="includes.{{ $i }}" placeholder="Include point" class="flex-1 h-10 px-3 rounded-md border
                                                                       bg-white dark:bg-gray-900
                                                                       text-gray-800 dark:text-gray-100
                                                                       placeholder-gray-400 dark:placeholder-gray-500">

                                    <button wire:click="removeInclude({{ $i }})" class="w-10 h-10 rounded-md
                                                                       bg-red-100 text-red-600
                                                                       dark:bg-red-900/40 dark:text-red-300">
                                        ✕
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <button wire:click="addInclude"
                            class="mt-3 text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                            + Add Include
                        </button>
                    </div>

                </div>

                <!-- Footer -->
                <div class="px-5 py-4 border-t dark:border-gray-700 flex justify-end gap-2">
                    <button wire:click="$set('showModal', false)" class="px-4 py-2 rounded-md border
                                           text-gray-700 dark:text-gray-300">
                        Cancel
                    </button>

                    <button wire:click="save" class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">
                        Save
                    </button>
                </div>

            </div>
        </div>
    @endif

</div>