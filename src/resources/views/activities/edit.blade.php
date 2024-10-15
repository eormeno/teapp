<x-crud-layout>
    <x-slot name="title">Modificar actividad</x-slot>
    <form action="{{ route('activities.update', $activity) }}" method="POST" class="mt-2" novalidate>
        @csrf
        <div class="mt-2">
            <x-label for="name" value="Nombre" />
            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $activity->name }}" required
                autofocus autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>
        <div class="mt-2">
            <x-label for="description" value="Descripción" />
            <textarea name="description" id="description" cols="30" rows="5"
                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                required>{{ $activity->description }}</textarea>
        </div>
        <div class="mt-2">
            <img src="data:image/png;base64,{{ $activity->image }}" alt="Imagen de la actividad" width="255">
        </div>
        <div class="mt-2">
            <x-label for="image" value="Imagen" />
            <x-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" required
                autocomplete="image" />
            <x-input-error for="image" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-button class="ml-4">
                {{ __('Modificar actividad') }}
            </x-button>
        </div>
    </form>

</x-crud-layout>
