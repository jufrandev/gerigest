@extends('layouts.app')

@php
    $title = 'Calendario de Actividades';
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Calendario de Actividades</h2>
                    <div>
                        <select id="user-selector" class="form-select form-select-sm" style="width: auto;">
                            <option value="">Mis Eventos</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $selectedUserId == $user->id ? 'selected' : '' }}>
                                    {{ $user->first_name }} {{ $user->last_name }} ({{ $user->username }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Detalles del Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Actividad:</strong> <span id="modal-activity-name"></span></p>
                <p><strong>Descripción:</strong> <span id="modal-activity-description"></span></p>
                <p><strong>Ubicación:</strong> <span id="modal-location-name"></span></p>
                <p><strong>Tipo de Actividad:</strong> <span id="modal-activity-type"></span></p>
                <p><strong>Inicio:</strong> <span id="modal-start-time"></span></p>
                <p><strong>Fin:</strong> <span id="modal-end-time"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const userSelector = document.getElementById('user-selector');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es', // Idioma español
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día'
        },
        events: function(fetchInfo, successCallback, failureCallback) {
            const userId = userSelector.value; // Obtener el usuario seleccionado
            const url = userId ? `{{ route('events.calendarData') }}?user_id=${userId}` : `{{ route('events.calendarData') }}`;
            fetch(url)
                .then(response => response.json())
                .then(data => successCallback(data))
                .catch(error => failureCallback(error));
        },
        eventClick: function (info) {
            // Obtener los datos del evento
            const event = info.event.extendedProps;

            // Llenar el modal con los datos del evento
            document.getElementById('modal-activity-name').textContent = info.event.title;
            document.getElementById('modal-activity-description').textContent = event.description || 'Sin descripción';
            document.getElementById('modal-location-name').textContent = event.location || 'Sin ubicación';
            document.getElementById('modal-activity-type').textContent = event.activity_type || 'Sin tipo';
            document.getElementById('modal-start-time').textContent = info.event.start.toLocaleString();
            document.getElementById('modal-end-time').textContent = info.event.end ? info.event.end.toLocaleString() : 'Sin hora de finalización';

            // Mostrar el modal
            const eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
            eventModal.show();
        }
    });

    calendar.render();

    // Actualizar eventos al cambiar el usuario seleccionado
    userSelector.addEventListener('change', function () {
        const selectedUserId = this.value;

        // Guardar el usuario seleccionado en la sesión
        fetch(`{{ route('events.calendar') }}?user_id=${selectedUserId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then(() => {
            calendar.refetchEvents();
        });
    });
});
</script>
@endpush
