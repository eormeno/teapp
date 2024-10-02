<x-event-layout>
    <x-slot name="title">Pacientes</x-slot>
    <a href="{{ route('patients.create') }}">Nuevo paciente</a>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>DNI</th>
                <th>Fecha de nacimiento</th>
                <th>Sexo</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td>{{ $patient->codigo }}</td>
                    <td>{{ $patient->apellidos }}</td>
                    <td>{{ $patient->nombres }}</td>
                    <td>{{ $patient->dni }}</td>
                    <td>{{ $patient->nacimiento }}</td>
                    <td>{{ $patient->sexo }}</td>
                    <td>{{ $patient->telefono }}</td>
                    <td>{{ $patient->email }}</td>
                    <td>
                        <a href="{{ route('patients.show', $patient) }}">Ver</a>
                        <a href="{{ route('patients.edit', $patient) }}">Editar</a>
                        <form action="{{ route('patients.destroy', $patient) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-event-layout>
