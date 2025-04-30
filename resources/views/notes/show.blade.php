@extends('layouts.app')

@section('content')
<div class="container col-12 col-md-8 col-lg-6 col-xl-4">
    <h1>Detalles de la Nota</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Título: {{ $note->title }}</h5>
            <p class="card-text">Autor: {{ $note->createdBy->full_name }}</p>
            <p class="card-text">Fecha: {{ $note->created_at }}</p>
            <p class="card-text">Tipo de Nota: {{ $note->noteType->name ?? 'Sin Tipo' }}</p>
            <p class="card-text">Prioridad: {{ $note->priority->name ?? 'Sin Prioridad' }}</p>
            <p class="card-text">Contenido: {{ $note->content ?? 'Sin contenido' }}</p>
        </div>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('notes.edit', $note) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('notes.index') }}" class="btn btn-secondary">Volver al Listado</a>
    </div>
</div>
@endsection
