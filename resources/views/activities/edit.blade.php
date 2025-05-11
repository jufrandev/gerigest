@extends('layouts.app')
@php
    $title = 'Editar Actividad';
@endphp

@section('content')
<div class="container col-12 col-md-8 col-lg-6 col-xl-4">
    <h1>Editar Actividad</h1>

    <form action="{{ route('activities.update', $activity) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $activity->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Descripción --}}
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $activity->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tipo de Actividad --}}
        <div class="mb-3">
            <label for="activity_type_id" class="form-label">Tipo de Actividad</label>
            <select name="activity_type_id" id="activity_type_id" class="form-select" required>
                <option value="" disabled>Seleccione un tipo de actividad</option>
                @foreach ($activityTypes as $type)
                    <option value="{{ $type->id }}" {{ old('activity_type_id', $activity->activity_type_id) == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            @error('activity_type_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Ubicación --}}
        <div class="mb-3">
            <label for="location_id" class="form-label">Ubicación</label>
            <select name="location_id" id="location_id" class="form-select" required>
                <option value="" disabled>Seleccione una ubicación</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}" {{ old('location_id', $activity->location_id) == $location->id ? 'selected' : '' }}>
                        {{ $location->name }}
                    </option>
                @endforeach
            </select>
            @error('location_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Botones --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('activities.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
