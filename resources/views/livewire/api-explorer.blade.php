<div class="p-6 space-y-6
            bg-gray-100 text-gray-900
            dark:bg-gray-900 dark:text-gray-100
            min-h-screen">

    <h1 class="text-2xl font-bold">
        API Explorer
    </h1>

    @foreach($routes as $index => $route)

        <div class="rounded-lg shadow p-4 space-y-4
                    bg-white border border-gray-200
                    dark:bg-gray-800 dark:border-gray-700">

            <div class="flex justify-between items-center">
                <div>
                    <p class="font-semibold
                              text-indigo-600
                              dark:text-indigo-400">
                        {{ $route['method'] }}
                    </p>

                    <p class="text-sm
                              text-gray-700
                              dark:text-gray-300">
                        {{ $route['uri'] }}
                    </p>
                </div>

                <button
                    wire:click="hitApi({{ $index }})"
                    class="px-4 py-2 rounded-md text-white
                           bg-indigo-600 hover:bg-indigo-700
                           transition">
                    Run
                </button>
            </div>

            {{-- Payload --}}
            @if($route['method'] !== 'GET')
                <textarea
                    wire:model.defer="payloads.{{ $index }}"
                    rows="5"
                    placeholder='{"key":"value"}'
                    class="w-full rounded-md px-3 py-2 text-sm font-mono
                           border
                           bg-white text-gray-900 border-gray-300
                           placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-indigo-500

                           dark:bg-gray-700 dark:text-white dark:border-gray-600
                           dark:placeholder-gray-400">
                </textarea>
            @endif

            {{-- Response --}}
            @if(isset($responses[$index]))
                <pre class="rounded-md p-4 text-xs overflow-auto leading-relaxed
                            border
                            bg-gray-900 text-green-400 border-gray-700
                            dark:bg-black dark:text-green-400">

Status: {{ $responses[$index]['status'] }}

{{ json_encode($responses[$index]['body'], JSON_PRETTY_PRINT) }}
                </pre>
            @endif

        </div>

    @endforeach

</div>
