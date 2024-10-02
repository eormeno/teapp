<x-event-layout>
    <x-slot name="title">Nuevo Pacientes</x-slot>
    <form action="{{ route('patients.store') }}" method="POST">
        @csrf
        <label for="codigo">Código</label>
        <input type="text" name="codigo" required>
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" required>
        <label for="nombres">Nombres</label>
        <input type="text" name="nombres" required>
        <label for="dni">DNI</label>
        <input type="text" name="dni" required>
        <label for="nacimiento">Fecha de nacimiento</label>
        <input type="date" name="nacimiento" required>
        <label for="sexo">Sexo</label>
        <select name="sexo" required>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select>
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" required>
        <label for="email">Email</label>
        <input type="email" name="email" required>
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" required>
        <label for="observaciones">Observaciones</label>
        <textarea name="observaciones"></textarea>
        <button type="submit">Guardar</button>
    </form>
</x-event-layout>
