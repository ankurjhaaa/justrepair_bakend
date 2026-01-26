<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">

    <div class="w-full max-w-md bg-white rounded-md shadow-lg">

        <!-- APP TABS (SAME AS LOGIN) -->
        <div class="p-3">
            <div class="flex bg-gray-100 rounded-md p-1">
                <a wire:navigate href="{{ route('login') }}" class="w-1/2 text-center py-2 text-sm font-semibold rounded-md
                          text-gray-500 hover:text-primary">
                    Login
                </a>

                <a wire:navigate href="{{ route('register') }}" class="w-1/2 text-center py-2 text-sm font-semibold rounded-md
                          bg-white text-primary shadow">
                    Sign Up
                </a>
            </div>
        </div>

        <!-- FORM -->
        <div class="px-6 pb-8">

            <h2 class="text-xl font-bold text-gray-800 text-center mt-2">
                Create Account
            </h2>

            <p class="text-sm text-gray-500 text-center mt-1">
                Join JustRepair in seconds
            </p>

            <form wire:submit.prevent="signup" class="mt-6 space-y-4">

                <!-- NAME -->
                <div>
                    <label class="text-sm font-medium text-gray-600">
                        Full Name
                    </label>
                    <input type="text" wire:model.defer="name" class="w-full mt-1 px-3 py-2.5 border rounded-md
                                  focus:ring-1 focus:ring-primary
                                  focus:border-primary outline-none" placeholder="Ankur Jha">

                    @error('name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- MOBILE -->
                <div>
                    <label class="text-sm font-medium text-gray-600">
                        Mobile Number
                    </label>
                    <input type="text" wire:model.defer="mobile" class="w-full mt-1 px-3 py-2.5 border rounded-md
                                  focus:ring-1 focus:ring-primary
                                  focus:border-primary outline-none" placeholder="763972896">

                    @error('mobile')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="text-sm font-medium text-gray-600">
                        Password
                    </label>
                    <input type="password" wire:model.defer="password" class="w-full mt-1 px-3 py-2.5 border rounded-md
                                  focus:ring-1 focus:ring-primary
                                  focus:border-primary outline-none" placeholder="********">

                    @error('password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- SUBMIT -->
                <button type="submit" class="w-full bg-primary text-white py-2.5 rounded-md
                           font-semibold hover:bg-primaryLight transition">
                    Create Account
                </button>

                <p class="text-xs text-gray-500 text-center leading-relaxed">
                    By signing up, you agree to our
                    <span class="text-primary font-medium">Terms</span> &
                    <span class="text-primary font-medium">Privacy Policy</span>
                </p>
            </form>
        </div>
    </div>
</div>