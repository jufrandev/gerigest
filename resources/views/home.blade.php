@extends('layouts.app')
@php
    $title = 'Inicio';
@endphp
@section('content')
{{-- /assets/img/hero_image.jpg --}}
    <section class="header">
        <div class="hero">
            <h1>Gestiona la atención geriátrica de forma humana y eficiente</h1>
            <p>GeriGest conecta centros, familias y profesionales para ofrecer el mejor cuidado a quienes más lo merecen.</p>
            <img src="/assets/img/hero_image.jpg" alt="Ilustración GeriGest" class="hero-image">
            <div>
                <a href="#" class="btn-primary">Solicitar una demo</a>
            </div>
        </div>
    </section>

    <section>
        <h2 style="text-align:center;">¿Qué es GeriGest?</h2>
        <p style="text-align:center; max-width:700px; margin:20px auto;">
            GeriGest es la plataforma que transforma la gestión de centros de atención a mayores.
            Organizamos actividades, tareas, incidencias y comunicación en un único lugar, mejorando la eficiencia del
            centro y la calidad de vida de sus residentes.
        </p>

        <div class="features">
            <div class="feature">
                <h3>Gestión integral de usuarios</h3>
                <p>Pacientes, familiares y empleados en una misma plataforma.</p>
            </div>
            <div class="feature">
                <h3>Actividades y tareas</h3>
                <p>Organiza fácilmente todo lo que ocurre en el centro.</p>
            </div>
            <div class="feature">
                <h3>Comunicación ágil</h3>
                <p>Mantén informadas a las familias en tiempo real.</p>
            </div>
            <div class="feature">
                <h3>Incidencias controladas</h3>
                <p>Registra y sigue eventos importantes al instante.</p>
            </div>
        </div>
    </section>

    <section class="steps">
        <h2 style="text-align:center;">¿Cómo funciona GeriGest?</h2>
        <ol>
            <li><strong>Configura tu centro</strong> en minutos.</li>
            <li><strong>Registra usuarios y empleados</strong> de forma sencilla.</li>
            <li><strong>Programa actividades</strong> y asigna tareas diarias.</li>
            <li><strong>Conecta con las familias</strong> y mejora la transparencia.</li>
        </ol>
    </section>
@endsection
