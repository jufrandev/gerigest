@extends('layouts.app')
@php
    $title = 'Login';
@endphp
@section('content')
<div class="container">
    <div class="row">
        <div class="container_logo col-4">
            <div class="logo">
                <img src="/assets/img/logo_300x300.png" alt="GeriGest Logo">
            </div>
            <h2 class="logo">Introduce tus credenciales:</h2>
            <form action="/login" method="POST">
                <label for="email" class="logo">Email:</label>
                <input type="email" class="logo" id="email" name="email" required>

                <label for="password" class="logo" class="logo">Password:</label>
                <input type="password" class="logo" id="password" name="password" required>

                <button type="submit" class="logo">Entrar</button>
            </form>
            <a class="logo" href="/forgot-password">Olvidé mi contraseña</a>
        </div>
    </div>
</div>

@endsection

