{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Usuario</h1>
    <p><strong>Nombre:</strong> {{ $user->full_name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Dirección:</strong> {{ $user->address }}</p>
    <p><strong>Teléfono:</strong> {{ $user->phone }}</p>
    <p><strong>Roles:</strong> {{ $user->roles->pluck('name')->join(', ') }}</p>

    @if ($user->patient)
        <h3>Información del Paciente</h3>
        <p><strong>Número de Habitación:</strong> {{ $user->patient->room_number }}</p>
    @endif

    @if ($user->healthcareWorker)
        <h3>Información del Sociosanitario</h3>
        <p><strong>Titulación:</strong> {{ $user->healthcareWorker->qualification }}</p>
    @endif

    @if ($user->familyMembers->isNotEmpty())
        <h3>Familiares Relacionados</h3>
        <ul>
            @foreach ($user->familyMembers as $familyMember)
                <li>{{ $familyMember->patient->user->full_name }}</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Usuario</h1>
    <table class="table table-primary table-striped table-hover table-bordered">
        <tbody>
            <tr>
                <th>Nombre Completo</th>
                <td>{{ $user->full_name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Dirección</th>
                <td>{{ $user->address }}</td>
            </tr>
            <tr>
                <th>Teléfono</th>
                <td>{{ $user->phone }}</td>
            </tr>
            <tr>
                <th>Roles</th>
                <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
            </tr>
            @if ($user->patient)
            <tr>
                <th>Número de Habitación</th>
                <td>{{ $user->patient->room_number }}</td>
            </tr>
            @endif
            @if ($user->healthcareWorker)
            <tr>
                <th>Titulación</th>
                <td>{{ $user->healthcareWorker->qualification }}</td>
            </tr>
            @endif
            @if ($user->familyMembers->isNotEmpty())
            <tr>
                <th>Familiares Relacionados</th>
                <td>
                    <ul>
                        @foreach ($user->familyMembers as $familyMember)
                            <li>{{ $familyMember->patient->user->full_name }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Editar</a>
</div>
@endsection
