@extends('layouts.app')
@php
    $title = 'Listado de Anotaciones';
@endphp

@section('content')
    <div class="container">
        <h1>Listado de anotaciones</h1>

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


        {{-- Botón para crear una nueva anotación--}}
        <a href="{{ route('notes.create') }}" class="btn btn-primary mb-3">Crear anotación</a>

        {{-- Filtros --}}
        <form method="GET" action="{{ route('notes.index') }}" class="mb-3">
            <div class="row g-2 align-items-center">
                {{-- Campo de búsqueda --}}
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Buscar..."
                        value="{{ request('search') }}">
                </div>

                {{-- Filtro por rango de fechas --}}
                <div class="col-md-2">
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-2">
                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>

                {{-- Filtro por tipo de anotación--}}
                <div class="col-md-2">
                    <select name="note_type_id" class="form-control">
                        <option value="">-- Tipo de anotación--</option>
                        @foreach ($noteTypes as $type)
                            <option value="{{ $type->id }}"
                                {{ request('note_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filtro por autor --}}
                <div class="col-md-3">
                    <select name="author" class="form-control">
                        <option value="">-- Autor --</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" {{ request('author') == $author->id ? 'selected' : '' }}>
                                {{ $author->full_name_with_username }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Botones de acción --}}
                <div class="col-md-2 d-flex gap-2 justify-end">
                    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                    <a href="{{ route('notes.index') }}" class="btn btn-secondary w-100">Limpiar</a>
                </div>
            </div>
        </form>

        {{-- Tabla de anotaciones --}}
        <form action="{{ route('notes.destroyMultiple') }}" method="POST" id="bulk-delete-form">
            @csrf
            @method('DELETE')

            <table class="table table-primary table-striped table-hover">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Fecha</th>
                        <th>Tipo de anotación</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notes as $note)
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="{{ $note->id }}"></td>
                            <td>{{ $note->id }}</td>
                            <td>{{ $note->title }}</td>
                            <td>{{ $note->createdBy->full_name }}</td>
                            <td>{{ $note->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $note->noteType->name ?? 'Sin Tipo' }}</td>
                            <td class="text-center">
                                <a href="{{ route('notes.show', $note) }}" class="btn btn-info btn-sm">Ver</a>
                                <button type="submit" form="delete-note-{{ $note->id }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta anotación?')">
                                    Borrar
                                </button>
                                <form id="delete-note-{{ $note->id }}" action="{{ route('notes.destroy', $note) }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-danger"
                onclick="return confirm('¿Estás seguro de que deseas eliminar las anotaciones seleccionadas?')">
                Borrar Seleccionadas
            </button>
        </form>

        {{-- Paginación --}}
        <div class="m-3 justify-content-center">
            {{ $notes->links() }}
        </div>
    </div>
    {{-- @include('js.common_script'); --}}
@endsection
