<x-crud-layout>
    <x-slot name="title">Detalle de la actividad</x-slot>
    <p>Nombre: {{ $activity->name }}</p>
    <p>Descripción: {{ $activity->description }}</p>
    <!-- display the activity's image decoded from base64 -->
    <img src="data:image/png;base64,{{ $activity->image }}" alt="Imagen de la actividad" width="255">

</x-crud-layout>
