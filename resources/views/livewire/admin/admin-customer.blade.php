<div>
    <div class="space-y-6">
        <!-- HEADER -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Customers
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Manage all registered customers
                </p>
            </div>
            <div>
                <button wire:click="$set('showModal', true)"
                    class="px-4 py-2 rounded-md bg-indigo-600 text-white text-sm">
                    + Add User
                </button>

            </div>
        </div>


        <!-- FILTER BAR -->
        <div class="bg-white dark:bg-gray-800 rounded-md shadow p-4">
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">

                <!-- Search -->
                <input type="text" wire:model.live="search" placeholder="Search name or mobile" class="h-11 px-3 rounded-md border
                           bg-white text-gray-800
                           dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">

                <!-- Date -->
                <input type="date" wire:model.live="date" class="h-11 px-3 rounded-md border
                           bg-white text-gray-800
                           dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">
                <!-- Role Filter -->
                <select wire:model.live="role" class="h-11 px-3 rounded-md border
                        bg-white text-gray-800
                        dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">
                    <option value="">All Roles</option>
                    <option value="user">User</option>
                    <option value="technician">Technician</option>
                </select>

                <!-- Reset -->
                <button wire:click="resetFilters" class="h-11 rounded-md border
                           bg-gray-50 text-gray-700
                           hover:bg-gray-100
                           dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">
                    Reset
                </button>
            </div>
        </div>

        <!-- CUSTOMERS TABLE -->
        <div class="bg-white dark:bg-gray-800 rounded-md shadow overflow-x-auto">

            <table class="w-full text-sm whitespace-nowrap
                          text-gray-700 dark:text-gray-200">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Customer</th>
                        <th class="px-4 py-3 text-left">Mobile</th>
                        <th class="px-4 py-3 text-left">Joined</th>
                        <th class="px-4 py-3 text-left">Role</th>
                        <th class="px-4 py-3 text-right">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                    @forelse($customers as $customer)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40">

                            <td class="px-4 py-3">
                                <p class="font-medium">
                                    {{ $customer->name ?? '—' }}
                                </p>
                            </td>

                            <td class="px-4 py-3">
                                {{ $customer->phone ?? '—' }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                {{ $customer->created_at->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $customer->role }}
                            </td>

                            <td class="px-4 py-3 text-right">
                                <a wire:navigate href="{{ route('admin.customerview', $customer->id) }}"
                                    class="px-3 py-1.5 text-xs rounded-md bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-200">
                                    View
                                </a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                No customers found
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <!-- Pagination -->
            <div class="p-4">
                {{ $customers->links() }}
            </div>
        </div>

    </div>
    @if($showModal)
        <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-800 w-full max-w-md rounded-lg p-6">

                <h2 class="text-lg font-semibold mb-4">Add User</h2>

                <div class="space-y-3">

                    <input wire:model="name" placeholder="Name"
                        class="w-full h-10 px-3 border rounded-md bg-white text-gray-800 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">

                    <input wire:model="phone" placeholder="Mobile"
                        class="w-full h-10 px-3 border rounded-md bg-white text-gray-800 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">

                    <input wire:model="email" placeholder="Email (optional)"
                        class="w-full h-10 px-3 border rounded-md bg-white text-gray-800 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">

                    <input wire:model="password" type="password" placeholder="Password"
                        class="w-full h-10 px-3 border rounded-md bg-white text-gray-800 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">

                    <!-- ROLE (MANDATORY) -->
                    <select wire:model="newRole"
                        class="w-full h-10 px-3 border rounded-md bg-white text-gray-800 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select Role</option>
                        <option value="user">User</option>
                        <option value="technician">Technician</option>
                    </select>

                    @error('newRole')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror

                </div>


                <div class="flex justify-end gap-2 mt-6">
                    <button wire:click="$set('showModal', false)" class="px-4 py-2 text-sm border rounded-md">
                        Cancel
                    </button>

                    <button wire:click="addUser" class="px-4 py-2 text-sm bg-indigo-600 text-white rounded-md">
                        Save
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>