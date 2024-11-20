<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight align-middle">
                <a href="{{ url('course', ['id' => $course->id]) }}">EDIT TASK: {{ $task->title }}</a>
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

    <x-form-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('update-task') }}" method="post">
            @csrf

            <input type="hidden" name="id" value="{{ $task->id }}">
            <input type="hidden" name="course_id" value="{{ $task->course_id }}">

            <div class="mt-4">
                <x-label for="title" value="{{ __('Title') }}" />
                <x-input id="title" name="title" type="text" autofocus class="block mt-1 w-full" value="{{$task->title}}"></x-input>
            </div>

            <div class="mt-4">
                <x-label for="description" value="{{ __('Description') }}" />
                <textarea name="description" id="description" cols="30" rows="5" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{$task->description}}</textarea>
            </div>

            <div class="mt-4">
                <x-label for="title" value="{{ __('Due date') }}" />
                <input type="datetime-local"
                    value="{{$task->due_date}}"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                    name="due_date" id="due-date">
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Update') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
