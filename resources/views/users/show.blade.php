@extends('layouts.app')
@php
    $title = 'Detalles del suario';
@endphp

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
