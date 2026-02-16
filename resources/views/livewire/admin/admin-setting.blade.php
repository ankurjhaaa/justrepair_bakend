<div class="p-2">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Site Settings</h2>
        <button wire:click="save"
            class="bg-brand hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition transform hover:scale-105 active:scale-95">
            Save Changes
        </button>
    </div>

    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 dark:bg-green-900/50 dark:text-green-300 dark:border-green-600 px-4 py-3 rounded relative mb-6"
            role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="space-y-6">

        {{-- 1. General & Business Info --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition-colors duration-300">
            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100 flex items-center gap-2">
                <i class="fa-solid fa-globe text-brand"></i> General Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Site Name</label>
                    <input type="text" wire:model="site_name"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors"
                        placeholder="JustRepair">
                    @error('site_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Tagline</label>
                    <input type="text" wire:model="site_tagline"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors"
                        placeholder="Repair Services">
                    @error('site_tagline') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Currency Code</label>
                    <input type="text" wire:model="currency"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors"
                        placeholder="INR">
                    @error('currency') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Currency Symbol</label>
                    <input type="text" wire:model="currency_symbol"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors"
                        placeholder="₹">
                    @error('currency_symbol') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Business Hours</label>
                    <input type="text" wire:model="business_hours"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors"
                        placeholder="Mon - Fri: 9am - 6pm">
                    @error('business_hours') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Footer About
                        Text</label>
                    <textarea wire:model="footer_about" rows="3"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors"></textarea>
                    @error('footer_about') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Copyright Text</label>
                    <input type="text" wire:model="copyright_text"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors"
                        placeholder="© 2024 JustRepair. All rights reserved.">
                    @error('copyright_text') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        {{-- 2. Contact Details --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition-colors duration-300">
            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100 flex items-center gap-2">
                <i class="fa-solid fa-address-book text-brand"></i> Contact Details
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Contact Email</label>
                    <input type="email" wire:model="contact_email"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors">
                    @error('contact_email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Support Email</label>
                    <input type="email" wire:model="support_email"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors">
                    @error('support_email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Phone Number</label>
                    <input type="text" wire:model="contact_phone"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors">
                    @error('contact_phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">WhatsApp Number</label>
                    <input type="text" wire:model="whatsapp_number"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors">
                    @error('whatsapp_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                <div class="md:col-span-2">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Address Line 1</label>
                    <input type="text" wire:model="address_line_1"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Address Line 2</label>
                    <input type="text" wire:model="address_line_2"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">City</label>
                    <input type="text" wire:model="city"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">State</label>
                    <input type="text" wire:model="state"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Country</label>
                    <input type="text" wire:model="country"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Postal Code</label>
                    <input type="text" wire:model="postal_code"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors">
                </div>
            </div>
        </div>

        {{-- 3. Social Media --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition-colors duration-300">
            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100 flex items-center gap-2">
                <i class="fa-solid fa-share-nodes text-brand"></i> Social Media
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Facebook URL</label>
                    <input type="url" wire:model="facebook_url"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Instagram URL</label>
                    <input type="url" wire:model="instagram_url"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Twitter (X) URL</label>
                    <input type="url" wire:model="twitter_url"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">LinkedIn URL</label>
                    <input type="url" wire:model="linkedin_url"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">YouTube URL</label>
                    <input type="url" wire:model="youtube_url"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors">
                </div>
            </div>
        </div>

        {{-- 4. SEO & Meta --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition-colors duration-300">
            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100 flex items-center gap-2">
                <i class="fa-solid fa-magnifying-glass text-brand"></i> SEO Configuration
            </h3>
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Meta Title</label>
                    <input type="text" wire:model="meta_title"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Meta
                        Description</label>
                    <textarea wire:model="meta_description" rows="2"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors"></textarea>
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Meta Keywords</label>
                    <input type="text" wire:model="meta_keywords"
                        class="shadow-sm appearance-none border border-gray-300 dark:border-gray-600 rounded w-full py-2 px-3 text-gray-700 dark:text-gray-100 bg-white dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-brand dark:focus:ring-indigo-500 focus:border-transparent transition-colors"
                        placeholder="repair, service, fast">
                </div>
            </div>
        </div>

        {{-- 5. System Controls --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transition-colors duration-300">
            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100 flex items-center gap-2">
                <i class="fa-solid fa-power-off text-brand"></i> System Controls
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-center justify-between border p-4 rounded-lg dark:border-gray-600">
                    <div>
                        <span class="block font-bold text-gray-700 dark:text-gray-200">Maintenance Mode</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Put the site offline for visitors.</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="maintenance_mode" class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-brand dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600">
                        </div>
                    </label>
                </div>

                <div class="flex items-center justify-between border p-4 rounded-lg dark:border-gray-600">
                    <div>
                        <span class="block font-bold text-gray-700 dark:text-gray-200">Registration Enabled</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Allow new users to sign up.</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="registration_enabled" class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-brand dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                        </div>
                    </label>
                </div>
            </div>
        </div>

    </div>
</div>