let carrera = document.getElementById('carrera');
let nivel = document.getElementById('nivel');
document.addEventListener('DOMContentLoaded', function () {
  $('#table_asistencia').DataTable({
    ajax: {
      url: ruta + 'controllers/asistenciaController.php?option=listar',
      dataSrc: ''
    },
    columns: [
      { data: 'id' },
      { data: 'fecha' },
      { data: 'codigo' },
      { data: 'nombre' },
      { data: 'carrera' },
      { data: 'nivel' },
      { data: 'ingreso' },
      { data: 'salida' },
      { data: 'accion' }
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
    },
    "order": [[0, 'desc']]
  });

  cargarCarreras();
  cargarNiveles();

  carrera.addEventListener('change', function (e) {
    if (e.target.value != '' && nivel.value != '') {
      cargarDatos(e.target.value, nivel.value);
    }
    console.log(e.target.value);
  });

  nivel.addEventListener('change', function (e) {
    if (e.target.value != '' && carrera.value != '') {
      cargarDatos(carrera.value, e.target.value);
    }
    console.log(e.target.value);
  });
})

function cargarCarreras() {
  axios.get(ruta + 'controllers/estudiantesController.php?option=datos&item=carreras')
    .then(function (response) {
      const info = response.data;
      let html = '<option value="">Seleccionar</option>';
      info.forEach(carrera => {
        html += `<option value="${carrera.id}">${carrera.nombre}</option>`;
      });
      carrera.innerHTML = html;
    })
    .catch(function (error) {
      console.log(error);
    });
}

function cargarNiveles() {
  axios.get(ruta + 'controllers/estudiantesController.php?option=datos&item=niveles')
    .then(function (response) {
      const info = response.data;
      let html = '<option value="">Seleccionar</option>';
      info.forEach(nivel => {
        html += `<option value="${nivel.id}">${nivel.nombre}</option>`;
      });
      nivel.innerHTML = html;
    })
    .catch(function (error) {
      console.log(error);
    });
}

function cargarDatos(carrera, nivel) {
  window.location = ruta + 'plantilla.php?pagina=ver&carrera=' + carrera + '&nivel=' + nivel;
}