@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Notas</h1>

    {{-- Botón para crear una nueva nota --}}
    <a href="{{ route('notes.create') }}" class="btn btn-primary mb-3">Crear Nota</a>

    {{-- Filtros --}}
    <form method="GET" action="{{ route('notes.index') }}" class="mb-3">
        <div class="row g-2 align-items-center">
            {{-- Campo de búsqueda --}}
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Buscar..." value="{{ request('search') }}">
            </div>

            {{-- Filtro por rango de fechas --}}
            <div class="col-md-2">
                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
            </div>

            {{-- Filtro por tipo de nota --}}
            <div class="col-md-2">
                <select name="note_type_id" class="form-control">
                    <option value="">-- Tipo de Nota --</option>
                    @foreach ($noteTypes as $type)
                        <option value="{{ $type->id }}" {{ request('note_type_id') == $type->id ? 'selected' : '' }}>
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
                            {{ $author->full_name }}
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

    {{-- Tabla de notas --}}
    <table class="table table-primary table-striped table-hover">
        <thead>
            <tr>
                <th>
                    <a href="{{ route('notes.index', ['sort_by' => 'id', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        ID
                    </a>
                </th>
                <th>Título</th>
                <th>Autor</th>
                <th>
                    <a href="{{ route('notes.index', ['sort_by' => 'created_at', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}">
                        Fecha
                    </a>
                </th>
                <th>Tipo de Nota</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notes as $note)
            <tr>
                <td>{{ $note->id }}</td>
                <td>{{ $note->title }}</td>
                <td>{{ $note->createdBy->full_name }}</td>
                <td>{{ $note->created_at }}</td>
                <td>{{ $note->noteType->name ?? 'Sin Tipo' }}</td>
                <td class="text-center">
                    <a href="{{ route('notes.show', $note) }}" class="btn btn-info btn-sm">Ver</a>
                    <form action="{{ route('notes.destroy', $note) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Paginación --}}
    <div class="m-3 justify-content-center">
        {{ $notes->links() }}
    </div>
</div>
@endsection
