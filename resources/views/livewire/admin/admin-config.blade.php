<div class="space-y-6 max-w-3xl">

    <!-- Header -->
    <div class="flex items-center justify-between min-h-[60px]">
        <div>
            <h1 class="text-xl font-bold text-gray-900">App Configuration</h1>
            <p class="text-xs text-gray-500 mt-1">Manage global application settings</p>
        </div>
    </div>

    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-md flex items-center gap-3 text-sm" role="alert">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-md overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-sm font-semibold text-gray-800">Version & Updates</h3>
        </div>
        
        <form wire:submit.prevent="save" class="p-5 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                
                {{-- Min Version --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                        Min Req Version
                    </label>
                    <input type="text" wire:model="min_req_version" 
                        class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors" 
                        placeholder="e.g. 1.0.0">
                    @error('min_req_version') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Current Version --}}
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1.5">
                        Current Version
                    </label>
                    <input type="text" wire:model="current_version" 
                        class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors" 
                        placeholder="e.g. 1.0.5">
                    @error('current_version') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Update URL --}}
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1.5">
                    Update URL
                </label>
                <input type="url" wire:model="update_url" 
                    class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors" 
                    placeholder="https://play.google.com/store/apps/...">
                @error('update_url') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Force Update --}}
            <div class="pt-2">
                <label class="relative inline-flex items-center cursor-pointer group">
                    <input type="checkbox" wire:model="force_update" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600 transition-colors group-hover:bg-gray-300 peer-checked:group-hover:bg-indigo-700"></div>
                    <div class="ml-3">
                        <span class="text-sm font-medium text-gray-900 block">Force Update Required</span>
                        <span class="text-xs text-gray-500 block">Require users to update the app to continue using it.</span>
                    </div>
                </label>
                @error('force_update') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="px-5 py-2.5 rounded-md bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition-colors shadow-sm">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
