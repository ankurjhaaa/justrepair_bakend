<div class="bg-gray-100 min-h-screen py-8 px-4 sm:px-6">

    <div class="max-w-6xl mx-auto bg-white shadow rounded-md overflow-hidden">

        <!-- ================= HEADER ================= -->
        <div class="border-b px-6 py-5 flex items-center gap-4">

            <div class="w-14 h-14 rounded-md bg-primary text-white
                        flex items-center justify-center text-xl font-bold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div>
                <h1 class="text-lg font-bold text-gray-900">
                    {{ auth()->user()->name }}
                </h1>
                <p class="text-sm text-gray-500">
                    {{ auth()->user()->phone }}
                </p>
            </div>
        </div>

        <!-- ================= CONTENT ================= -->
        <div class="grid grid-cols-1 md:grid-cols-3">

            <livewire:user.component.profile-sidebar />

            <!-- RIGHT FORM -->
            <div class="md:col-span-2 p-6">

                <h2 class="text-lg font-bold text-gray-900 mb-6">
                    Profile Information
                </h2>

                @if(session('success'))
                    <div class="mb-4 text-sm text-green-700 bg-green-50 px-4 py-2 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit.prevent="updateProfile" class="space-y-5">

                    <!-- NAME -->
                    <div>
                        <label class="text-sm font-medium text-gray-600">Full Name</label>
                        <input wire:model.defer="name" class="w-full mt-1 border rounded-md px-4 py-2.5
                      focus:ring-1 focus:ring-primary focus:border-primary">
                    </div>

                    <!-- MOBILE (READ ONLY) -->
                    <div>
                        <label class="text-sm font-medium text-gray-600">Mobile</label>
                        <input value="{{ $mobile }}" disabled class="w-full mt-1 border rounded-md px-4 py-2.5
                      bg-gray-100 text-gray-500 cursor-not-allowed">
                        <p class="text-xs text-gray-400 mt-1">
                            Mobile number cannot be changed
                        </p>
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="text-sm font-medium text-gray-600">New Password</label>
                        <input type="password" wire:model.defer="password"
                            class="w-full mt-1 border rounded-md px-4 py-2.5">
                        <p class="text-xs text-gray-400 mt-1">
                            Leave blank if you don’t want to change password
                        </p>
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div>
                        <label class="text-sm font-medium text-gray-600">Confirm Password</label>
                        <input type="password" wire:model.defer="password_confirmation"
                            class="w-full mt-1 border rounded-md px-4 py-2.5">
                    </div>

                    <!-- SAVE -->
                    <div class="pt-4">
                        <button class="bg-primary text-white px-6 py-2.5 rounded-md font-semibold">
                            Save Changes
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>