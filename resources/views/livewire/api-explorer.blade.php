<div class="space-y-6">

    <div class="flex items-center justify-between min-h-[60px]">
        <div>
            <h1 class="text-xl font-bold text-gray-900">
                API Explorer
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Test and verify application endpoints
            </p>
        </div>
    </div>

    @foreach($routes as $index => $route)

        <div class="bg-white rounded-md p-5 border border-gray-200 shadow-sm transition-all hover:shadow-md space-y-4">

            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold uppercase tracking-wide border
                        {{ $route['method'] === 'GET' ? 'bg-blue-50 text-blue-700 border-blue-200' :
                        ($route['method'] === 'POST' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' :
                        ($route['method'] === 'PUT' || $route['method'] === 'PATCH' ? 'bg-amber-50 text-amber-700 border-amber-200' :
                        'bg-red-50 text-red-700 border-red-200')) }}">
                        {{ $route['method'] }}
                    </span>

                    <p class="text-sm font-mono text-gray-700">
                        {{ $route['uri'] }}
                    </p>
                </div>

                <button wire:click="hitApi({{ $index }})"
                    class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white shadow-sm hover:bg-indigo-700 transition">
                    <i class="fa-solid fa-play text-xs mr-2"></i> Run API
                </button>
            </div>

            {{-- Payload --}}
            @if($route['method'] !== 'GET')
                <div>
                    <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-1.5">JSON Payload</label>
                    <textarea wire:model.defer="payloads.{{ $index }}" rows="4" placeholder='{"key":"value"}'
                        class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-3 bg-gray-50 text-gray-900 font-mono placeholder-gray-400"></textarea>
                </div>
            @endif

            {{-- Response --}}
            @if(isset($responses[$index]))
                <div class="mt-4 border-t border-gray-100 pt-4">
                    <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-1.5">
                        Response Status: <span class="{{ str_starts_with($responses[$index]['status'], '2') ? 'text-emerald-600' : 'text-red-600' }}">{{ $responses[$index]['status'] }}</span>
                    </label>
                    <pre class="rounded-md p-4 text-xs overflow-auto leading-relaxed border bg-gray-900 text-green-400 border-gray-800 font-mono shadow-inner">
{{ json_encode($responses[$index]['body'], JSON_PRETTY_PRINT) }}
                    </pre>
                </div>
            @endif

        </div>

    @endforeach

</div>
