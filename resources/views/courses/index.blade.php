<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight align-middle">
                <a href="{{ url('course', ['id' => $course->id]) }}">{{ $course->title }}</a>
            </h2>

            <div>
                @if (auth()->user()->rol == 'teacher')
                    <x-href url="{{ url('edit-course', ['id' => $course->id]) }}">Edit Course</x-href>
                    <x-href url="{{ url('members', ['id' => $course->id]) }}">Members</x-href>
                    <x-href url="{{ url('create-task', ['id' => $course->id]) }}">Create Task</x-href>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="pt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 text-center">
                DESCRIPTION
            </h5>
            <p class="mb-3 font-normal text-gray-700">
                {{ $course->description }}
            </p>
        </div>

    </div>
    @livewire('task-list', ['id' => $course->id])

</x-app-layout>
