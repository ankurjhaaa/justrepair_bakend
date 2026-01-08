<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">Service Rates</h1>
            <p class="text-sm text-gray-500">Manage pricing plans</p>
        </div>

        <button wire:click="create" class="px-4 py-2 rounded-md bg-indigo-600 text-white text-sm">
            + Add Rate
        </button>
    </div>

    <!-- TABLE -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-5 py-3 text-left">Service</th>
                    <th class="px-5 py-3 text-left">Title</th>
                    <th class="px-5 py-3 text-left">Price</th>
                    <th class="px-5 py-3 text-left">Duration</th>
                    <th class="px-5 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y dark:divide-gray-700">
                @forelse($rates as $rate)
                    <tr>
                        <td class="px-5 py-3">{{ $rate->service->name }}</td>
                        <td class="px-5 py-3 font-medium">{{ $rate->title }}</td>
                        <td class="px-5 py-3">
                            ₹{{ $rate->discount_price ?? $rate->price }}
                        </td>
                        <td class="px-5 py-3">{{ $rate->duration }}</td>
                        <td class="px-5 py-3 text-right space-x-2">
                            <button wire:click="edit({{ $rate->id }})" class="text-indigo-600 text-sm">Edit</button>
                            <button wire:click="delete({{ $rate->id }})" class="text-red-600 text-sm">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-6 text-center text-gray-500">
                            No service rates found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- MODAL -->
    @if($showModal)
        <div class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center px-3">
            <div class="bg-white dark:bg-gray-800 w-full max-w-lg rounded-md">

                <div class="px-5 py-4 border-b">
                    <h2 class="font-semibold">
                        {{ $isEdit ? 'Edit Rate' : 'Add Rate' }}
                    </h2>
                </div>

                <div class="p-5 space-y-4">

                    <select wire:model="service_id" class="w-full h-11 px-3 rounded-md border">
                        <option value="">Select Service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>

                    <input wire:model="title" placeholder="Title" class="w-full h-11 px-3 rounded-md border">

                    <input wire:model="duration" placeholder="Duration (eg: 30 mins)"
                        class="w-full h-11 px-3 rounded-md border">

                    <div class="grid grid-cols-2 gap-3">
                        <input wire:model="price" placeholder="Price" class="h-11 px-3 rounded-md border">
                        <input wire:model="discount_price" placeholder="Discount Price" class="h-11 px-3 rounded-md border">
                    </div>

                    <!-- INCLUDES -->
                    <div>
                        <label class="text-sm font-medium">Includes</label>
                        <div class="space-y-2 mt-2">
                            @foreach($includes as $i => $inc)
                                <div class="flex gap-2">
                                    <input wire:model="includes.{{ $i }}" class="flex-1 h-11 px-3 rounded-md border"
                                        placeholder="Include point">
                                    <button wire:click="removeInclude({{ $i }})"
                                        class="w-11 h-11 bg-red-100 text-red-600 rounded-md">
                                        ✕
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <button wire:click="addInclude" class="mt-2 text-sm text-indigo-600 font-semibold">
                            + Add Include
                        </button>
                    </div>

                </div>

                <div class="px-5 py-4 border-t flex justify-end gap-2">
                    <button wire:click="$set('showModal', false)" class="px-4 py-2 border rounded-md">
                        Cancel
                    </button>
                    <button wire:click="save" class="px-4 py-2 bg-indigo-600 text-white rounded-md">
                        Save
                    </button>
                </div>

            </div>
        </div>
    @endif

</div>