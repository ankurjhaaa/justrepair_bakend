<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">

    <div class="w-full max-w-md bg-white rounded-md shadow-lg">

        <!-- APP TABS -->
        <div class="p-3">
            <div class="flex bg-gray-100 rounded-md p-1">
                <a wire:navigate href="{{ route('login') }}" class="w-1/2 text-center py-2 text-sm font-semibold rounded-md
                          bg-white text-primary shadow">
                    Login
                </a>

                <a wire:navigate href="{{ route('register') }}" class="w-1/2 text-center py-2 text-sm font-semibold rounded-md
                          text-gray-500 hover:text-primary">
                    Sign Up
                </a>
            </div>
        </div>

        <!-- FORM -->
        <div class="px-6 pb-8">

            <h2 class="text-xl font-bold text-gray-800 text-center mt-2">
                Welcome Back
            </h2>

            <p class="text-sm text-gray-500 text-center mt-1">
                Login using your mobile number
            </p>

            <form wire:submit.prevent="login" class="mt-6 space-y-4">

                <!-- MOBILE -->
                <div>
                    <label class="text-sm font-medium text-gray-600">
                        Mobile Number
                    </label>
                    <input type="text" wire:model.defer="mobile" class="w-full mt-1 px-3 py-2.5 border rounded-md
                                  focus:ring-1 focus:ring-primary
                                  focus:border-primary outline-none" placeholder="9876543210">
                    @error('mobile') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- PASSWORD (ONLY IF NOT OTP MODE) -->
                @if(!$otpMode)
                    <div>
                        <label class="text-sm font-medium text-gray-600">
                            Password
                        </label>
                        <input type="password" wire:model.defer="password" class="w-full mt-1 px-3 py-2.5 border rounded-md
                                          focus:ring-1 focus:ring-primary
                                          focus:border-primary outline-none">
                        @error('password') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-between text-sm">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" wire:model="remember" class="rounded">
                            Remember me
                        </label>
                    </div>
                @endif

                <!-- OTP MODE -->
                @if($otpMode)
                    <div>
                        <label class="text-sm font-medium text-gray-600">
                            OTP
                        </label>
                        <input type="text" wire:model.defer="otp" class="w-full mt-1 px-3 py-2.5 border rounded-md
                                          focus:ring-1 focus:ring-primary
                                          focus:border-primary outline-none" placeholder="1234">
                        @error('otp') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                @endif

                <!-- SUBMIT -->
                <button type="submit" class="w-full bg-primary text-white py-2.5 rounded-md
                               font-semibold hover:bg-primaryLight transition">
                    {{ $otpMode ? 'Verify OTP' : 'Login' }}
                </button>
            </form>

            <!-- OTP TOGGLE (CLEAN PLACE) -->
            <div class="text-center mt-6">
                <button wire:click="toggleOtp" class="text-sm text-primary font-medium hover:underline">
                    {{ $otpMode ? 'Login with Password' : 'Login with OTP' }}
                </button>
            </div>

        </div>
    </div>
</div>