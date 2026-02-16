<div class="p-2">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">App Configuration</h2>
    </div>

    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 dark:bg-green-900/50 dark:text-green-300 dark:border-green-600 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="max-w-2xl">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition-colors duration-300">
            <h3 class="text-lg font-semibold mb-6 text-gray-800 dark:text-gray-100">Edit Configuration</h3>
            
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Min Version --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Min Req Version
                        </label>
                        <input type="text" wire:model="min_req_version" 
                            class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors" 
                            placeholder="e.g. 1.0.0">
                        @error('min_req_version') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Current Version --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Current Version
                        </label>
                        <input type="text" wire:model="current_version" 
                            class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors" 
                            placeholder="e.g. 1.0.5">
                        @error('current_version') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Update URL --}}
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                        Update URL
                    </label>
                    <input type="url" wire:model="update_url" 
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors" 
                        placeholder="https://play.google.com/store/apps/...">
                    @error('update_url') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Force Update --}}
                <div class="mb-6">
                    <div class="flex items-center">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model="force_update" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Force Update Required</span>
                        </label>
                    </div>
                    @error('force_update') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-start justify-end mt-6">
                    <button type="submit" 
                        class="bg-brand hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-150 ease-in-out transform hover:scale-105 active:scale-95 shadow-md">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
