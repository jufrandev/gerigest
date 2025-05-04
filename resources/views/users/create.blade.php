@extends('layouts.app')
@php
    $title = 'Crear Usuario';
@endphp

@section('content')
<div class="container">
    <h1>Crear Usuario</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="border border-2 border-dark rounded-2 p-3 my-3">
            <div class="mb-3">
                <label for="first_name" class="form-label">Nombre</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Apellido</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Rol</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="sociosanitario" {{ old('role') == 'sociosanitario' ? 'selected' : '' }}>Sociosanitario</option>
                    <option value="usuario" {{ old('role') == 'usuario' ? 'selected' : '' }}>Usuario</option>
                    <option value="familiar" {{ old('role') == 'familiar' ? 'selected' : '' }}>Familiar</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Crear usuario</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
