let calendar;
let calendarEl = document.getElementById('registro');
let estudiante = document.getElementById('id');
document.addEventListener('DOMContentLoaded', function () {
    calendar = new FullCalendar.Calendar(calendarEl, {
        timeZone: 'local',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        locale: 'es',
        events: ruta + 'controllers/asistenciaController.php?option=verAsistencia&estudiante=' + estudiante.value

    });
    calendar.render();
})