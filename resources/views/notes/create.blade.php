@extends('layouts.app')

@section('content')
<div class="container col-12 col-md-8 col-lg-6 col-xl-4">
    <h1>Crear nueva anotación</h1>

    <form action="{{ route('notes.store') }}" method="POST">
        @csrf

        {{-- Título --}}
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Contenido --}}
        <div class="mb-3">
            <label for="content" class="form-label">Contenido</label>
            <textarea name="content" id="content" class="form-control" rows="5">{{ old('content') }}</textarea>
        </div>

        {{-- Tipo de anotación--}}
        <div class="mb-3">
            <label for="note_type_id" class="form-label">Tipo de anotación</label>
            <select name="note_type_id" id="note_type_id" class="form-control">
                <option value="">-- Seleccionar Tipo --</option>
                @foreach ($noteTypes as $type)
                    <option value="{{ $type->id }}" {{ old('note_type_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Prioridad --}}
        <div class="mb-3">
            <label for="priority_id" class="form-label">Prioridad</label>
            <select name="priority_id" id="priority_id" class="form-control">
                <option value="">-- Seleccionar Prioridad --</option>
                @foreach ($priorities as $priority)
                    <option value="{{ $priority->id }}" {{ old('priority_id') == $priority->id ? 'selected' : '' }}>
                        {{ $priority->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Botones --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('notes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
