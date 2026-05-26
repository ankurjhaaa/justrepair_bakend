<div class="space-y-6 max-w-4xl pb-10">

    <!-- Header -->
    <div class="flex items-center justify-between min-h-[60px]">
        <div>
            <h1 class="text-xl font-bold text-gray-900">Site Settings</h1>
            <p class="text-xs text-gray-500 mt-1">Manage all global platform settings and configurations</p>
        </div>
        <div class="flex items-center gap-3">
            <button wire:click="save" class="flex items-center gap-2 px-5 py-2.5 rounded-md bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition-colors shadow-sm">
                <i class="fa-solid fa-floppy-disk"></i> <span>Save Changes</span>
            </button>
        </div>
    </div>

    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-md flex items-center gap-3 text-sm" role="alert">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="space-y-5">

        {{-- 1. General & Business Info --}}
        <div class="bg-white border border-gray-200 rounded-md overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-globe text-gray-400"></i> General Information
                </h3>
            </div>
            
            <div class="p-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Site Name</label>
                        <input type="text" wire:model="site_name"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors"
                            placeholder="JustRepair">
                        @error('site_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Tagline</label>
                        <input type="text" wire:model="site_tagline"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors"
                            placeholder="Repair Services">
                        @error('site_tagline') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Site Logo -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Site Logo</label>
                        <div class="flex items-center gap-3">
                            <div class="h-14 w-14 rounded-md border border-gray-200 bg-gray-50 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                @if ($site_logo)
                                    <img src="{{ $site_logo->temporaryUrl() }}" class="h-full w-full object-contain p-1">
                                @elseif($existing_site_logo)
                                    <img src="{{ asset('storage/' . $existing_site_logo) }}" class="h-full w-full object-contain p-1">
                                @else
                                    <i class="fa-regular fa-image text-gray-400"></i>
                                @endif
                            </div>

                            <div class="flex-1">
                                <input type="file" wire:model="site_logo" accept="image/*" class="block w-full text-xs text-gray-500
                                    file:mr-3 file:py-1.5 file:px-3
                                    file:rounded-md file:border-0
                                    file:text-xs file:font-medium
                                    file:bg-indigo-50 file:text-indigo-700
                                    hover:file:bg-indigo-100 transition-colors
                                " />
                                <div wire:loading wire:target="site_logo" class="text-xs text-indigo-500 mt-1 block">Uploading...</div>
                            </div>
                        </div>
                        @error('site_logo') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Favicon -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Favicon</label>
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-md border border-gray-200 bg-gray-50 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                @if ($favicon)
                                    <img src="{{ $favicon->temporaryUrl() }}" class="h-full w-full object-contain p-1">
                                @elseif($existing_favicon)
                                    <img src="{{ asset('storage/' . $existing_favicon) }}" class="h-full w-full object-contain p-1">
                                @else
                                    <i class="fa-regular fa-image text-gray-400"></i>
                                @endif
                            </div>

                            <div class="flex-1">
                                <input type="file" wire:model="favicon" accept="image/*" class="block w-full text-xs text-gray-500
                                    file:mr-3 file:py-1.5 file:px-3
                                    file:rounded-md file:border-0
                                    file:text-xs file:font-medium
                                    file:bg-indigo-50 file:text-indigo-700
                                    hover:file:bg-indigo-100 transition-colors
                                " />
                                <div wire:loading wire:target="favicon" class="text-xs text-indigo-500 mt-1 block">Uploading...</div>
                            </div>
                        </div>
                        @error('favicon') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Currency Code</label>
                        <input type="text" wire:model="currency"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors"
                            placeholder="INR">
                        @error('currency') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Currency Symbol</label>
                        <input type="text" wire:model="currency_symbol"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors"
                            placeholder="₹">
                        @error('currency_symbol') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Business Hours</label>
                        <input type="text" wire:model="business_hours"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors"
                            placeholder="Mon - Fri: 9am - 6pm">
                        @error('business_hours') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Footer About Text</label>
                        <textarea wire:model="footer_about" rows="3"
                            class="w-full py-2 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors resize-none"></textarea>
                        @error('footer_about') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Copyright Text</label>
                        <input type="text" wire:model="copyright_text"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors"
                            placeholder="© 2024 JustRepair. All rights reserved.">
                        @error('copyright_text') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. Contact Details --}}
        <div class="bg-white border border-gray-200 rounded-md overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-address-book text-gray-400"></i> Contact Details
                </h3>
            </div>
            
            <div class="p-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Contact Email</label>
                        <input type="email" wire:model="contact_email"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                        @error('contact_email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Support Email</label>
                        <input type="email" wire:model="support_email"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                        @error('support_email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Phone Number</label>
                        <input type="text" wire:model="contact_phone"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                        @error('contact_phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">WhatsApp Number</label>
                        <input type="text" wire:model="whatsapp_number"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                        @error('whatsapp_number') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5 pt-5 border-t border-gray-100">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Address Line 1</label>
                        <input type="text" wire:model="address_line_1"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Address Line 2</label>
                        <input type="text" wire:model="address_line_2"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">City</label>
                        <input type="text" wire:model="city"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">State</label>
                        <input type="text" wire:model="state"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Country</label>
                        <input type="text" wire:model="country"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Postal Code</label>
                        <input type="text" wire:model="postal_code"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. Social Media --}}
        <div class="bg-white border border-gray-200 rounded-md overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-share-nodes text-gray-400"></i> Social Media Links
                </h3>
            </div>
            
            <div class="p-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Facebook URL</label>
                        <input type="url" wire:model="facebook_url"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Instagram URL</label>
                        <input type="url" wire:model="instagram_url"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Twitter (X) URL</label>
                        <input type="url" wire:model="twitter_url"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">LinkedIn URL</label>
                        <input type="url" wire:model="linkedin_url"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">YouTube URL</label>
                        <input type="url" wire:model="youtube_url"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. SEO & Meta --}}
        <div class="bg-white border border-gray-200 rounded-md overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i> SEO Configuration
                </h3>
            </div>
            
            <div class="p-5">
                <div class="grid grid-cols-1 gap-5">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Meta Title</label>
                        <input type="text" wire:model="meta_title"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Meta Description</label>
                        <textarea wire:model="meta_description" rows="2"
                            class="w-full py-2 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Meta Keywords</label>
                        <input type="text" wire:model="meta_keywords"
                            class="w-full h-10 px-3 text-sm rounded-md border border-gray-300 bg-white text-gray-900 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-colors"
                            placeholder="repair, service, fast">
                    </div>
                </div>
            </div>
        </div>

        {{-- 5. System Controls --}}
        <div class="bg-white border border-gray-200 rounded-md overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-power-off text-gray-400"></i> System Controls
                </h3>
            </div>
            
            <div class="p-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="flex items-center justify-between border border-gray-200 p-4 rounded-md">
                        <div>
                            <span class="block text-sm font-medium text-gray-900">Maintenance Mode</span>
                            <span class="text-xs text-gray-500">Put the site offline for visitors.</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer group">
                            <input type="checkbox" wire:model="maintenance_mode" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500 transition-colors group-hover:bg-gray-300 peer-checked:group-hover:bg-red-600"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between border border-gray-200 p-4 rounded-md">
                        <div>
                            <span class="block text-sm font-medium text-gray-900">Registration Enabled</span>
                            <span class="text-xs text-gray-500">Allow new users to sign up.</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer group">
                            <input type="checkbox" wire:model="registration_enabled" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500 transition-colors group-hover:bg-gray-300 peer-checked:group-hover:bg-emerald-600"></div>
                        </label>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>