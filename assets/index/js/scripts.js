const contactForm = document.querySelector('#contactForm');
const codigo = document.querySelector('#codigo');
const entrada = document.querySelector('#entrada');
const salida = document.querySelector('#salida');
document.addEventListener('DOMContentLoaded', function () {
    // reloj digital
    let actualizarHora = function () {
        let fecha = new Date(),
            horas = fecha.getHours(),
            ampm,
            minutos = fecha.getMinutes(),
            segundos = fecha.getSeconds(),
            diaSemana = fecha.getDay(),
            dia = fecha.getDate(),
            mes = fecha.getMonth(),
            year = fecha.getFullYear();

        let pHoras = document.getElementById('horas'),
            pAMPM = document.getElementById('ampm'),
            pMinutos = document.getElementById('minutos'),
            pSegundos = document.getElementById('segundos'),
            pDiaSemana = document.getElementById('diaSemana'),
            pDia = document.getElementById('dia'),
            pMes = document.getElementById('mes'),
            pYear = document.getElementById('year');

        let semana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
        pDiaSemana.textContent = semana[diaSemana];

        pDia.textContent = dia;
        let meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Obtubre', 'Noviembre', 'Diciembre'];
        pMes.textContent = meses[mes];

        pYear.textContent = year;

        if (horas >= 12) {
            horas = horas - 12;
            ampm = 'PM';
        } else {
            ampm = 'AM';
        }

        if (horas == 0) {
            horas = 12;
        }

        pHoras.textContent = horas;
        pAMPM.textContent = ampm;

        if (minutos < 10) { minutos = "0" + minutos };
        if (segundos < 10) { segundos = "0" + segundos };

        pMinutos.textContent = minutos;
        pSegundos.textContent = segundos;
    }

    actualizarHora();

    let invertalo = setInterval(actualizarHora, 1000);

    contactForm.onsubmit = function (e) {
        e.preventDefault();
        if (codigo.value == '') {
            message('error', 'EL CODIGO ES REQUERIDO');
        } else {
            const data = new FormData(contactForm);
            axios.post(ruta + 'controllers/asistenciaController.php?option=registrar', data)
                .then(function (response) {
                    const info = response.data;
                    message(info.tipo, info.mensaje);
                    if (info.tipo == 'success') {
                        codigo.value = '';
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

    }
})