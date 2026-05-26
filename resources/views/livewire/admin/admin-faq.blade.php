<div x-data="{ mobileFilterOpen: false }" class="space-y-5 pb-20 md:pb-0">

    <!-- HEADER -->
    <div class="flex items-center justify-between min-h-[60px]">
        <div>
            <h1 class="text-xl font-bold text-gray-900">FAQs</h1>
            <p class="text-xs text-gray-500 mt-1">Manage service specific & global FAQs</p>
        </div>
        
        <div class="flex items-center gap-3">
            <!-- Mobile Filter Button -->
            <button @click="mobileFilterOpen = true" class="md:hidden flex items-center gap-2 px-3 py-2 text-sm font-medium border border-gray-200 rounded-md bg-white text-gray-700 hover:bg-gray-50 active:bg-gray-100 transition-colors">
                <i class="fa-solid fa-filter text-gray-500"></i> <span>Filters</span>
            </button>
            
            <!-- Desktop Add Button -->
            <button wire:click="create" class="hidden md:flex items-center gap-2 px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition-colors shadow-sm">
                <i class="fa-solid fa-plus"></i> <span>Add FAQ</span>
            </button>
        </div>
    </div>

    <!-- DESKTOP FILTER BAR -->
    <div class="hidden md:flex flex-wrap items-center gap-3 bg-white border border-gray-200 rounded-md p-3">
        <!-- Search -->
        <div class="relative flex-1 min-w-[240px]">
            <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text" wire:model.live="search" placeholder="Search FAQ title" class="w-full h-9 pl-9 pr-3 text-sm rounded-md border border-gray-200 bg-white text-gray-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-colors">
        </div>

        <!-- Filter Service -->
        <select wire:model.live="filterService" class="w-48 h-9 px-3 text-sm rounded-md border border-gray-200 bg-white text-gray-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-colors">
            <option value="">All FAQs</option>
            <option value="global">Global FAQs</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
            @endforeach
        </select>

        <!-- Reset -->
        <button wire:click="$set('filterService',''); $set('search','')" class="h-9 px-4 text-sm font-medium rounded-md border border-gray-200 bg-gray-50 text-gray-700 hover:bg-gray-100 transition-colors">
            Reset
        </button>
    </div>

    <!-- MOBILE FILTER BOTTOM SHEET -->
    <div x-show="mobileFilterOpen" class="relative z-50 md:hidden" x-cloak>
        <div x-show="mobileFilterOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm" @click="mobileFilterOpen = false"></div>
        <div x-show="mobileFilterOpen" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="translate-y-full" 
             x-transition:enter-end="translate-y-0" 
             x-transition:leave="transition ease-in duration-200" 
             x-transition:leave-start="translate-y-0" 
             x-transition:leave-end="translate-y-full" 
             class="fixed inset-x-0 bottom-0 bg-white rounded-t-xl p-5 border-t border-gray-200 shadow-2xl">
            
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-base font-semibold text-gray-900">Filters</h3>
                <button @click="mobileFilterOpen = false" class="p-1 text-gray-400 hover:text-gray-600 rounded-md">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Search</label>
                    <input type="text" wire:model.live="search" placeholder="Search FAQ title" class="w-full h-10 px-3 text-sm rounded-md border border-gray-200 bg-white text-gray-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Service Type</label>
                    <select wire:model.live="filterService" class="w-full h-10 px-3 text-sm rounded-md border border-gray-200 bg-white text-gray-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                        <option value="">All FAQs</option>
                        <option value="global">Global FAQs</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-3 flex gap-3">
                    <button wire:click="$set('filterService',''); $set('search','')" @click="mobileFilterOpen = false" class="flex-1 h-10 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-700 hover:bg-gray-50">Reset</button>
                    <button @click="mobileFilterOpen = false" class="flex-1 h-10 text-sm font-medium rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Apply Filters</button>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ LIST -->
    <div class="space-y-3">
        @forelse($faqs as $faq)
            <div class="bg-white border border-gray-200 rounded-md p-4 transition-colors hover:border-gray-300">
                <div class="flex justify-between items-start gap-4">
                    <div class="flex-1">
                        <h3 class="font-medium text-gray-900">{{ $faq->title }}</h3>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $faq->service_id ? ($services->firstWhere('id', $faq->service_id)?->name) : 'Global FAQ' }}
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <button wire:click="edit({{ $faq->id }})" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors" title="Edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button wire:click="delete({{ $faq->id }})" class="p-1.5 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>

                <div class="mt-3 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-3">
                    {{ $faq->description }}
                </div>
            </div>
        @empty
            <div class="flex flex-col items-center justify-center bg-white border border-gray-200 rounded-md p-10">
                <i class="fa-regular fa-comments text-3xl mb-3 text-gray-300"></i>
                <p class="text-sm text-gray-500">No FAQs found</p>
            </div>
        @endforelse
    </div>

    <!-- MOBILE FLOATING ADD BUTTON -->
    <button wire:click="create" class="md:hidden fixed bottom-6 right-6 z-40 flex items-center justify-center w-14 h-14 bg-indigo-600 text-white rounded-full shadow-lg hover:bg-indigo-700 hover:scale-105 transition-transform">
        <i class="fa-solid fa-plus text-xl"></i>
    </button>

    <!-- ADD/EDIT MODAL -->
    <div x-show="$wire.showModal" class="relative z-50" x-cloak>
        <!-- Backdrop -->
        <div x-show="$wire.showModal" x-transition.opacity class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm" @click="$wire.showModal = false"></div>

        <!-- Modal panel -->
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
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-gray-100 overflow-y-auto flex-1">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">
                                    {{ $isEdit ? 'Edit FAQ' : 'Add FAQ' }}
                                </h3>
                                <button @click="$wire.showModal = false" type="button" class="text-gray-400 hover:text-gray-600">
                                    <i class="fa-solid fa-xmark text-lg"></i>
                                </button>
                            </div>
                            <div class="space-y-4 mt-2">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Service</label>
                                    <select wire:model="service_id" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                                        <option value="">Global FAQ</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Title</label>
                                    <input type="text" wire:model.defer="title" placeholder="FAQ Title" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Description</label>
                                    <textarea wire:model.defer="description" placeholder="FAQ Description" class="w-full h-28 px-3 py-2 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors resize-none"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 sm:ml-3 sm:w-auto">Save</button>
                            <button @click="$wire.showModal = false" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>