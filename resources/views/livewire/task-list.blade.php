<div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">
    @foreach ($tasks as $t)
        <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
            <div class="flex justify-between">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                    TASK: {{ $t->title }}
                </h5>

                <p class="font-normal text-gray-700">
                    Due date: {{ $t->due_date }}
                </p>
            </div>
            <p class="mb-3 font-normal text-gray-700">
                {{ $t->description }}
            </p>

            @if (auth()->user()->rol == 'teacher')
                <x-href url="{{ url('edit-task', ['id' => $t->id]) }}">
                    Edit
                </x-href>

                <x-button class="bg-red-800 hover:bg-red-700 focus:bg-red-600" type="button"
                    wire:click="deleteTask({{ $t->id }})">
                    Delete
                </x-button>
            @endif
        </div>
    @endforeach
</div>
