@extends('layouts.app')
@php
    $title = 'Eventos';
@endphp

@php
    $title = 'Eventos';
@endphp

@section('content')
<div class="container">
    <h1>Eventos</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Filtro por usuario --}}
    <form action="{{ route('events.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="user_id" id="user_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Todos los usuarios</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->username }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <form action="{{ route('events.destroyMultiple') }}" method="POST" id="bulk-delete-form">
        @csrf
        @method('DELETE')

        <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Crear Evento</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombre de evento</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td><input type="checkbox" name="ids[]" value="{{ $event->id }}"></td>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->user->username }}</td>
                        <td>{{ $event->activity->name }}</td>
                        <td>{{ $event->start_time }}</td>
                        <td>{{ $event->end_time }}</td>
                        <td>
                            <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de eliminar este evento?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-danger mb-3"
            onclick="return confirm('¿Estás seguro de que deseas eliminar los eventos seleccionados?')">
            Eliminar Seleccionados
        </button>

        {{ $events->appends(['user_id' => request('user_id')])->links() }}
    </form>
</div>
@endsection
