<div x-data="{ mobileFilterOpen: false }" class="space-y-5 pb-20 md:pb-0">
    
    <!-- HEADER -->
    <div class="flex items-center justify-between min-h-[60px]">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Technicians</h1>
            <p class="text-xs text-gray-500 mt-1">Manage all service technicians</p>
        </div>
        
        <div class="flex items-center gap-3">
            <!-- Mobile Filter Button -->
            <button @click="mobileFilterOpen = true" class="md:hidden flex items-center gap-2 px-3 py-2 text-sm font-medium border border-gray-200 rounded-md bg-white text-gray-700 hover:bg-gray-50 active:bg-gray-100 transition-colors">
                <i class="fa-solid fa-filter text-gray-500"></i> <span>Filters</span>
            </button>
            
            <button wire:click="$set('showModal', true)" class="hidden md:flex items-center gap-2 px-4 py-2 rounded-md bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition-colors shadow-sm">
                <i class="fa-solid fa-plus"></i> <span>Add Technician</span>
            </button>
        </div>
    </div>

    <!-- DESKTOP FILTER BAR -->
    <div class="hidden md:flex flex-wrap items-center gap-3 bg-white border border-gray-200 rounded-md p-3">
        <!-- Search -->
        <div class="relative flex-1 min-w-[240px]">
            <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text" wire:model.live="search" placeholder="Search name or mobile" class="w-full h-9 pl-9 pr-3 text-sm rounded-md border border-gray-200 bg-white text-gray-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-colors">
        </div>


        <!-- Date -->
        <input type="date" wire:model.live="date" class="w-40 h-9 px-3 text-sm rounded-md border border-gray-200 bg-white text-gray-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-colors">

        <!-- Reset -->
        <button wire:click="resetFilters" class="h-9 px-4 text-sm font-medium rounded-md border border-gray-200 bg-gray-50 text-gray-700 hover:bg-gray-100 transition-colors">
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
                    <input type="text" wire:model.live="search" placeholder="Search name or mobile" class="w-full h-10 px-3 text-sm rounded-md border border-gray-200 bg-white text-gray-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                </div>
                

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Joined Date</label>
                    <input type="date" wire:model.live="date" class="w-full h-10 px-3 text-sm rounded-md border border-gray-200 bg-white text-gray-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                </div>

                <div class="pt-3 flex gap-3">
                    <button wire:click="resetFilters" @click="mobileFilterOpen = false" class="flex-1 h-10 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-700 hover:bg-gray-50">Reset</button>
                    <button @click="mobileFilterOpen = false" class="flex-1 h-10 text-sm font-medium rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Apply Filters</button>
                </div>
            </div>
        </div>
    </div>

    <!-- TECHNICIANS TABLE -->
    <div class="bg-white border border-gray-200 rounded-md overflow-x-auto">
        <table class="w-full text-sm text-left whitespace-nowrap text-gray-700">
            <thead class="bg-gray-50 text-gray-600 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 font-medium">Technician</th>
                    <th class="px-4 py-3 font-medium">Mobile</th>
                    <th class="px-4 py-3 font-medium">Joined</th>
                    <th class="px-4 py-3 font-medium">Role</th>
                    <th class="px-4 py-3 font-medium text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($technicians as $technician)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold text-xs border border-indigo-100">
                                    {{ strtoupper(substr($technician->name ?? 'T', 0, 1)) }}
                                </div>
                                <div class="font-medium text-gray-900">{{ $technician->name ?? '—' }}</div>
                            </div>
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-800">
                            {{ $technician->phone ?? '—' }}
                        </td>
                        <td class="px-4 py-3 text-gray-600">
                            {{ $technician->created_at->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-[11px] font-medium rounded-md border bg-purple-50 text-purple-700 border-purple-200">
                                {{ ucfirst($technician->role) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a wire:navigate href="{{ route('admin.technicianview', $technician->id) }}" class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium bg-white border border-gray-200 text-gray-700 rounded-md hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fa-solid fa-users text-3xl mb-3 text-gray-300"></i>
                                <p class="text-sm">No technicians found</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($technicians->hasPages())
            <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
                {{ $technicians->links() }}
            </div>
        @endif
    </div>

    <!-- MOBILE FLOATING ADD BUTTON -->
    <button wire:click="$set('showModal', true)" class="md:hidden fixed bottom-24 right-6 z-40 flex items-center justify-center w-14 h-14 bg-indigo-600 text-white rounded-full shadow-lg hover:bg-indigo-700 hover:scale-105 transition-transform">
        <i class="fa-solid fa-plus text-xl"></i>
    </button>

    <!-- ADD TECHNICIAN MODAL -->
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
                    <form wire:submit.prevent="addTechnician" class="flex flex-col h-full overflow-hidden">
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-gray-100 overflow-y-auto flex-1">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">Add New Technician</h3>
                                <button @click="$wire.showModal = false" type="button" class="text-gray-400 hover:text-gray-600">
                                    <i class="fa-solid fa-xmark text-lg"></i>
                                </button>
                            </div>
                            <div class="space-y-4 mt-2">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Name</label>
                                    <input wire:model="name" autocomplete="name" placeholder="John Doe" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                                    @error('name') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Mobile</label>
                                    <input wire:model="phone" autocomplete="tel" placeholder="9876543210" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                                    @error('phone') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Email (Optional)</label>
                                    <input wire:model="email" autocomplete="username email" placeholder="john@example.com" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                                    @error('email') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Password</label>
                                    <input wire:model="password" type="password" autocomplete="new-password" placeholder="••••••••" class="w-full h-10 px-3 text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                                    @error('password') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
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