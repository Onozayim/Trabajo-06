<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Curses') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            </div>
        </div>
    </div> --}}
    <div class=" py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="grid grid-cols-3 gap-4">
            @foreach ($courses as $c)
                <a href="{{ url('course', [$c->id]) }}"
                    class="min-h-40 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                        {{ $c->title }}
                    </h5>
                    <p class="font-normal text-gray-700">
                        {{ substr($c->description, 0, 100) }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
