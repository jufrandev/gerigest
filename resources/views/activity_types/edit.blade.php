
{{-- filepath: resources/views/activity_types/edit.blade.php --}}
@extends('layouts.app')
@php
    $title = 'Editar Tipo de Actividad';
@endphp

@section('content')
<div class="container col-12 col-md-8 col-lg-6 col-xl-4">
    <h1>Editar Tipo de Actividad</h1>

    <form action="{{ route('activity-types.update', $activityType) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $activityType->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Descripción --}}
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $activityType->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Botones --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('activity-types.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
