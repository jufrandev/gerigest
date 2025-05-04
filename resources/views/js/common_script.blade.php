<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleccionar todos los checkboxes
        const selectAllCheckbox = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('input[name="ids[]"]');

        selectAllCheckbox?.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        // Mostrar alerta de éxito o error
        const alertSuccess = document.getElementById('alert-success');
        const alertError = document.getElementById('alert-error');

        if (alertSuccess) {
            setTimeout(() => {
                const closeButton = alertSuccess.querySelector('.btn-close');
                if (closeButton) closeButton.click(); // Emular clic en el botón de cerrar
            }, 2000); // 2 segundos
        }

        if (alertError) {
            setTimeout(() => {
                const closeButton = alertError.querySelector('.btn-close');
                if (closeButton) closeButton.click(); // Emular clic en el botón de cerrar
            }, 2000); // 2 segundos
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        
        const calendarEl = document.getElementById('calendar')
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
        })
        calendar.render()

    });
</script>
