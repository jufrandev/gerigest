
@extends('layouts.app')
@php
    $title = 'Tipos de Actividades';
@endphp

@section('content')
<div class="container">
    <h1>Tipos de Actividades</h1>

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

    {{-- Botón para crear un nuevo tipo de actividad --}}
    <a href="{{ route('activity-types.create') }}" class="btn btn-primary mb-3">Crear Tipo de Actividad</a>

    {{-- Tabla de tipos de actividades --}}
    <form action="{{ route('activity-types.destroyMultiple') }}" method="POST" id="bulk-delete-form">
        @csrf
        @method('DELETE')

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activityTypes as $activityType)
                <tr>
                    <td><input type="checkbox" name="ids[]" value="{{ $activityType->id }}"></td>
                    <td>{{ $activityType->id }}</td>
                    <td>{{ $activityType->name }}</td>
                    <td>{{ $activityType->description }}</td>
                    <td class="text-center">
                        <a href="{{ route('activity-types.edit', $activityType) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('activity-types.destroy', $activityType) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este tipo de actividad?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-danger mt-3"
            onclick="return confirm('¿Estás seguro de que deseas eliminar los tipos de actividad seleccionados?')">
            Eliminar Seleccionados
        </button>
    </form>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
        {{ $activityTypes->links() }}
    </div>
</div>
@endsection
