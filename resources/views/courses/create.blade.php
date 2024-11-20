<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight align-middle">
                CREATE COURSE
            </h2>
        </div>
    </x-slot>

    <x-form-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form action="{{ route('make-course') }}" method="post">
            @csrf

            <div class="mt-4">
                <x-label for="title" value="{{ __('Title') }}" />
                <x-input id="title" name="title" type="text" autofocus class="block mt-1 w-full"></x-input>
            </div>

            <div class="mt-4">
                <x-label for="description" value="{{ __('Description') }}" />
                <textarea name="description" id="description" cols="30" rows="5" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"></textarea>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Create') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
