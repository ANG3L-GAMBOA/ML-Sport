document.addEventListener('DOMContentLoaded', function () {
    totales()
})
function totales() {
    axios.get(ruta + 'controllers/adminController.php?option=totales')
        .then(function (response) {
            const info = response.data;
            console.log(info);
            document.querySelector('#totalUsuarios').textContent = info.usuario.total;
            document.querySelector('#totalEst').textContent = info.estudiante.total;
            document.querySelector('#totalAsistencia').textContent = info.asistencia.total;
            document.querySelector('#totalCarreras').textContent = info.carrera.total;
        })
        .catch(function (error) {
            console.log(error);
        });
}