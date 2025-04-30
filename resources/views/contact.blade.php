@extends('layouts.app')
@php
    $title = 'Contáctanos';
@endphp
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h2>Contáctanos</h2>
            <hr>
            <p>Si tienes alguna pregunta o necesitas más información, no dudes en ponerte en contacto con nosotros. </p><p>Estamos aquí para ayudarte.</p>
            <form action="#" method="POST">
                @csrf
                <div class="form-group col-3 mx-auto">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <label for="message">Mensaje:</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    <hr>
                </div>
                <div class="form-group col-3 mx-auto justify-between">
                    <button type="submit" class="btn btn-secundario ">Enviar</button>
                </div>
        </div>
    </div>
</div>

@endsection

