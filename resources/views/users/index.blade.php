@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Usuarios</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Crear Usuario</a>
    <form action="{{ route('users.destroy', 0) }}" method="POST" id="bulk-delete-form">
        @csrf
        @method('DELETE')
        <table class="table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td><input type="checkbox" name="ids[]" value="{{ $user->id }}"></td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {{ $user->roles->pluck('name')->join(', ') }}
                    </td>
                    <td>
                        <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">Editar</a>
                        <button type="submit" form="delete-user-{{ $user->id }}" class="btn btn-danger btn-sm">Borrar</button>
                        <form id="delete-user-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-danger">Borrar Seleccionados</button>
    </form>
</div>
@endsection
