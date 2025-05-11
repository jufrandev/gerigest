@extends('layouts.app')
@php
    $title = 'Crear Evento';
@endphp

@section('content')
<div class="container">
    <h1>Crear Evento</h1>

    <form action="{{ route('events.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Usuario</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="" disabled selected>Seleccione un usuario</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="activity_id" class="form-label">Actividad</label>
            <select name="activity_id" id="activity_id" class="form-select" required>
                <option value="" disabled selected>Seleccione una actividad</option>
                @foreach ($activities as $activity)
                    <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Inicio</label>
            <input type="datetime-local" name="start_time" id="start_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">Fin</label>
            <input type="datetime-local" name="end_time" id="end_time" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
