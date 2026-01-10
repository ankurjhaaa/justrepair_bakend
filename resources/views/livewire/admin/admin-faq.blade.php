<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold">FAQs</h1>
            <p class="text-sm text-gray-500">
                Manage service specific & global FAQs
            </p>
        </div>

        <button wire:click="create" class="px-4 py-2 rounded-md bg-indigo-600 text-white">
            + Add FAQ
        </button>
    </div>

    <!-- FILTER BAR -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">

            <input type="text" wire:model.live="search" placeholder="Search FAQ title" class="h-11 px-3 rounded-md border
                       bg-white dark:bg-gray-700 dark:text-white dark:border-gray-600">

            <select wire:modellive="filterService" class="h-11 px-3 rounded-md border
                       bg-white dark:bg-gray-700 dark:text-white dark:border-gray-600">
                <option value="">All FAQs</option>
                <option value="global">Global FAQs</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>

            <button wire:click="$set('filterService',''); $set('search','')" class="h-11 rounded-md border
                       bg-gray-50 dark:bg-gray-700">
                Reset
            </button>
        </div>
    </div>

    <!-- FAQ LIST -->
    <div class="space-y-3">

        @forelse($faqs as $faq)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4">

                <div class="flex justify-between items-start gap-3">
                    <div>
                        <h3 class="font-semibold">{{ $faq->title }}</h3>

                        <p class="text-xs text-gray-500 mt-1">
                            {{ $faq->service_id
            ? ($services->firstWhere('id', $faq->service_id)?->name)
            : 'Global FAQ'
                                }}
                        </p>
                    </div>

                    <div class="flex gap-2">
                        <button wire:click="edit({{ $faq->id }})" class="px-3 py-1.5 text-xs rounded-md
                                       bg-blue-100 text-blue-700
                                       dark:bg-blue-900 dark:text-blue-200">
                            Edit
                        </button>

                        <button wire:click="delete({{ $faq->id }})" class="px-3 py-1.5 text-xs rounded-md
                                       bg-red-100 text-red-700
                                       dark:bg-red-900 dark:text-red-200">
                            Delete
                        </button>
                    </div>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-300 mt-3">
                    {{ $faq->description }}
                </p>
            </div>
        @empty
            <p class="text-center text-gray-500">
                No FAQs found
            </p>
        @endforelse

    </div>

    <!-- MODAL -->
    @if($showModal)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 px-3">
            <div class="bg-white dark:bg-gray-800 w-full max-w-lg rounded-xl shadow">

                <div class="px-5 py-4 border-b dark:border-gray-700">
                    <h2 class="font-semibold">
                        {{ $isEdit ? 'Edit FAQ' : 'Add FAQ' }}
                    </h2>
                </div>

                <div class="p-5 space-y-4">

                    <select wire:model="service_id" class="w-full h-11 px-3 rounded-md border
                                   bg-white dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        <option value="">Global FAQ</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>

                    <input type="text" wire:model.defer="title" placeholder="FAQ Title" class="w-full h-11 px-3 rounded-md border
                                   bg-white dark:bg-gray-700 dark:text-white dark:border-gray-600">

                    <textarea wire:model.defer="description" placeholder="FAQ Description" class="w-full h-28 px-3 py-2 rounded-md border
                                   bg-white dark:bg-gray-700 dark:text-white dark:border-gray-600"></textarea>
                </div>

                <div class="px-5 py-4 border-t dark:border-gray-700 flex justify-end gap-2">
                    <button wire:click="$set('showModal', false)" class="px-4 py-2 rounded-md border">
                        Cancel
                    </button>

                    <button wire:click="save" class="px-4 py-2 rounded-md bg-indigo-600 text-white">
                        Save
                    </button>
                </div>

            </div>
        </div>
    @endif

</div>