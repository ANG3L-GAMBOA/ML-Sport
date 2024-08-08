const frm = document.querySelector('#frmEstudiante');
const codigo = document.querySelector('#codigo');
const telefono = document.querySelector('#telefono');
const nombre = document.querySelector('#nombre');
const apellido = document.querySelector('#apellido');
const direccion = document.querySelector('#direccion');
const carrera = document.querySelector('#carrera');
const nivel = document.querySelector('#nivel');
const id_estudiante = document.querySelector('#id_estudiante');
const btn_nuevo = document.querySelector('#btn-nuevo');
const btn_save = document.querySelector('#btn-save');
document.addEventListener('DOMContentLoaded', function () {
  
  cargarCarreras();
  cargarNiveles();

  $('#table_estudiantes').DataTable({
    ajax: {
      url: ruta + 'controllers/estudiantesController.php?option=listar',
      dataSrc: ''
    },
    columns: [
      { data: 'id' },
      { data: 'carreras' },
      { data: 'codigo' },
      { data: 'nombres' },
      { data: 'telefono' },
      { data: 'direccion' },      
      { data: 'niveles' },
      { data: 'accion' }
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
    },
    "order": [[0, 'desc']]
  });
  frm.onsubmit = function (e) {
    e.preventDefault();
    if (codigo.value == '' || telefono.value == '' || nombre.value == ''
    || apellido.value == '' || direccion.value == '' || carrera.value == '' || nivel.value == '') {
      message('error', 'TODO LOS CAMPOS CON * SON REQUERIDOS')
    } else {
      const frmData = new FormData(frm);
      axios.post(ruta + 'controllers/estudiantesController.php?option=save', frmData)
        .then(function (response) {
          const info = response.data;
          message(info.tipo, info.mensaje);
          if (info.tipo == 'success') {
            setTimeout(() => {
              window.location.reload();
            }, 1500);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  }
  btn_nuevo.onclick = function () {
    frm.reset();
    id_estudiante.value = '';
    btn_save.innerHTML = 'Guardar';
    codigo.focus();
  }
})

function deleteEst(id) {
  Snackbar.show({
    text: 'Esta seguro de eliminar',
    width: '475px',
    actionText: 'Si eliminar',
    backgroundColor: '#FF0303',
    onActionClick: function (element) {
      axios.get(ruta + 'controllers/estudiantesController.php?option=delete&id=' + id)
        .then(function (response) {
          const info = response.data;
          message(info.tipo, info.mensaje);
          if (info.tipo == 'success') {
            setTimeout(() => {
              window.location.reload();
            }, 1500);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  });

}

function editEst(id) {
  axios.get(ruta + 'controllers/estudiantesController.php?option=edit&id=' + id)
    .then(function (response) {
      const info = response.data;
      codigo.value = info.codigo;
      telefono.value = info.telefono;
      nombre.value = info.nombre;
      direccion.value = info.direccion;
      carrera.value = info.id_carrera;
      nivel.value = info.id_nivel;
      id_estudiante.value = info.id;
      btn_save.innerHTML = 'Actualizar';
      codigo.focus();
    })
    .catch(function (error) {
      console.log(error);
    });
}

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