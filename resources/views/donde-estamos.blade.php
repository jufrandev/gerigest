@extends('layouts.app')
@php
    $title = 'Donde estamos';
@endphp
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>¿Dónde estamos?</h2>
            <hr>
            <div class="text-center">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2975.2182611695603!2d-16.251915000104567!3d28.46640887096381!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2ses!4v1745676796828!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <hr>
            <p>Estamos ubicados en la Calle Santa Cruz, 1, 38000 Santa Cruz, Santa Cruz de Tenerife, España.</p>
        </div>
    </div>
</div>
@endsection

