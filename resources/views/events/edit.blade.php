@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Evento</h1>

        <form action="{{ route('events.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="redirect" value="{{ request('redirect') }}">


            <div class="mb-3">
                <label for="activity_id" class="form-label">Actividad</label>
                <select class="form-control" id="activity_id" name="activity_id" required>
                    <option value="">Seleccione una actividad</option>
                    @foreach ($activities as $activity)
                        <option value="{{ $activity->id }}" {{ $event->activity_id == $activity->id ? 'selected' : '' }}>
                            {{ $activity->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">Usuario</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    <option value="">Seleccione un usuario</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $event->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->full_name_with_username }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Hora de Inicio</label>
                <input type="datetime-local" class="form-control" id="start_time" name="start_time"
                    value="{{ old('start_time', $event->start_time ? $event->start_time->format('Y-m-d\TH:i') : '') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">Hora de Fin</label>
                <input type="datetime-local" class="form-control" id="end_time" name="end_time"
                    value="{{ old('end_time', $event->end_time ? $event->end_time->format('Y-m-d\TH:i') : '') }}">
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
@endsection
