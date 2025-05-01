@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Usuarios</h1>

    {{-- Mensajes de éxito o error --}}
    @if (session('success'))
        <div id="alert-success" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div id="alert-error" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Crear Usuario</a>
    <form action="{{ route('users.destroy', 0) }}" method="POST" id="bulk-delete-form">
        @csrf
        @method('DELETE')
        <table class="table table-primary table-striped table-hover">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>ID</th>
                    <th>UserName</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td><input type="checkbox" name="ids[]" value="{{ $user->id }}"></td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {{ $user->roles->pluck('name')->join(', ') }}
                    </td>
                    <td class="text-center">
                        <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm">Ver</a>
                        <button type="submit" form="delete-user-{{ $user->id }}" class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                            Borrar
                        </button>
                        <form id="delete-user-{{ $user->id }}" action="{{ route('users.destroySingle', $user) }}" method="post" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-danger"
            onclick="return confirm('¿Estás seguro de que deseas eliminar los usuarios seleccionados?')">
            Borrar Seleccionados
        </button>
    </form>
    <div class="m-3 justify-content-center">
        {{ $users->links() }}
    </div>
</div>
@include('js.common_script');
@endsection
