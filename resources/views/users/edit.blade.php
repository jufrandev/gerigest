@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-2">
            <h1>Editar Usuario</h1>
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="border border-2 border-dark rounded-2 p-3 my-3">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Nombre</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $user->first_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Apellido</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $user->last_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <small class="text-muted">Dejar en blanco para mantener la contraseña actual.</small>
                    </div>
                    @if ($user->hasRole('sociosanitario'))
                    <div class="mb-3">
                        <label for="qualification" class="form-label">Titulación</label>
                        <input type="text" name="qualification" id="qualification" class="form-control" value="{{ $user->healthcareWorker?->qualification }}">
                    </div>
                    @elseif ($user->hasRole('usuario'))
                    <div class="mb-3">
                        <label for="room_number" class="form-label">Número de Habitación</label>
                        <input type="text" name="room_number" id="room_number" class="form-control" value="{{ $user->patient->room_number }}">
                    </div>
                    @elseif ($user->hasRole('familiar'))
                    <div class="mb-3">
                        <label for="related_patients" class="form-label">Pacientes Relacionados</label>
                        <select name="related_patients[]" id="related_patients" class="form-select" multiple>
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}" {{ in_array($patient->id, $user->familyMembers->pluck('patient_id')->toArray()) ? 'selected' : '' }}>
                                    {{ $patient->user->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
