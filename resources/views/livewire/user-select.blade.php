<div class="py-12 max-w-7xl mx-auto px-6 lg:px-8">
    <form wire:submit="save">
    <x-button class="mb-4" :disabled="$disabled">
            SAVE
        </x-button>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <div id="dropdownSearch" class="z-10  bg-white rounded-lg shadow w-60">
                <div class="p-3">
                    <label for="input-group-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input wire:model.live="username" type="text" id="username" name="username"
                            class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Search student">
                    </div>
                </div>
                <ul class="min-h-48 px-3 pb-3 overflow-y-auto text-sm" aria-labelledby="dropdownSearchButton">
                    <li>
                        @foreach ($users as $u)
                            <div class="flex items-center ps-2 rounded hover:bg-gray-100">
                                <p wire:click="addUser({{ json_encode($u) }})"
                                    class="w-full py-2 ms-2 text-sm font-medium text-gray-900">
                                    {{ $u['name'] }}
                                </p>
                            </div>
                        @endforeach
                    </li>
                </ul>
            </div>

            <div class="col-span-3">
                <div class="bg-white rounded-lg shadow  h-full px-3 pb-3 overflow-y-auto">
                    <h2 class="text-center mt-3 text-xl font-semibold">COURSE MEMBERS</h2>
                    @foreach ($selected as $s)
                        <p wire:click="removeUser({{ json_encode($s) }})"
                            class="w-full py-2 px-3 ms-2 text-sm font-medium text-gray-900 hover:bg-gray-100">
                            {{ $s['name'] }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </form>
</div>
