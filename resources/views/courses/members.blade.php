<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight align-middle">
                <a href="{{ url('course', ['id' => $course->id]) }}">MEMBERS OF: {{ $course->title }}</a>
            </h2>

            <div>
                @if (auth()->user()->rol == 'teacher')
                    <x-href url="{{ url('edit-course', ['id' => $course->id]) }}">Edit Course</x-href>
                    {{-- <x-href url="{{ url('members', ['id' => $course->id]) }}">Members</x-href> --}}
                    <x-href url="{{ url('create-task', ['id' => $course->id]) }}">Create Task</x-href>
                @endif
            </div>
        </div>
    </x-slot>

    @livewire('user-select', ['id' => $course->id])
</x-app-layout>
