@extends('layouts.app')
@php
    $title = 'Actividades';
@endphp

@section('content')
<div class="container">
    <h1>Actividades</h1>

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
    <a href="{{ route('activities.create') }}" class="btn btn-primary mb-3">Crear Actividad</a>

    {{-- Tabla de tipos de actividades --}}
    <form action="{{ route('activities.destroyMultiple') }}" method="POST" id="bulk-delete-form">
        @csrf
        @method('DELETE')

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th style="width: 30%">Descripción</th>
                    <th>Tipo de Actividad</th>
                    <th>Ubicación</th>
                    <th>Creado por</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $activity)
                <tr>
                    <td><input type="checkbox" name="ids[]" value="{{ $activity->id }}"></td>
                    <td>{{ $activity->id }}</td>
                    <td>{{ $activity->name }}</td>
                    <td>
                        <div class="text-truncate" style="max-width: 200px;">
                            {{ $activity->description }}
                        </div>
                    </td>
                    <td>{{ $activity->activityType->name }}</td>
                    <td>{{ $activity->location->name }}</td>
                    <td>{{ $activity->creator->username ?? '' }}</td>
                    <td class="text-center">
                        <a href="{{ route('activities.edit', $activity) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('activities.destroy', $activity) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta actividad?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-danger mt-3"
            onclick="return confirm('¿Estás seguro de que deseas eliminar las actividades seleccionadas?')">
            Eliminar Seleccionadas
        </button>
    </form>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
        {{ $activities->links() }}
    </div>
</div>
@endsection

