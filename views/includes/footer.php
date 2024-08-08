</div>
        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
        <footer class="footer">
          <div class="card">
            <div class="card-body">
              <div class="d-sm-flex justify-content-center justify-content-sm-between py-2">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a> templates</span>
              </div>
            </div>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="<?php echo RUTA . 'assets/'; ?>vendor/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="<?php echo RUTA . 'assets/'; ?>vendor/chart.js/Chart.min.js"></script>
  <script src="<?php echo RUTA . 'assets/'; ?>js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?php echo RUTA . 'assets/'; ?>js/off-canvas.js"></script>
  <script src="<?php echo RUTA . 'assets/'; ?>js/hoverable-collapse.js"></script>
  <script src="<?php echo RUTA . 'assets/'; ?>js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php echo RUTA . 'assets/'; ?>js/dashboard.js"></script>
  <!-- End custom js for this page-->

  <script src="<?php echo RUTA . 'assets/'; ?>js/snackbar.min.js"></script>
<script src="<?php echo RUTA . 'assets/'; ?>js/axios.min.js"></script>

<script type="text/javascript" src="<?php echo RUTA . 'assets/'; ?>vendor/DataTables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo RUTA . 'assets/'; ?>vendor/all.min.js"></script>
<script type="text/javascript" src="<?php echo RUTA . 'assets/'; ?>js/full-calendar.js"></script>
<script type="text/javascript" src="<?php echo RUTA . 'assets/'; ?>js/es.js"></script>
<script type="text/javascript" src="<?php echo RUTA . 'assets/'; ?>js/jquery-ui.min.js"></script>

<script>
    const ruta = '<?php echo RUTA; ?>';

    function message(tipo, mensaje) {
        Snackbar.show({
            text: mensaje,
            pos: 'top-right',
            backgroundColor: tipo == 'success' ? '#079F00' : '#FF0303',
            actionText: 'Cerrar'
        });
    }

    //autocomplete clientes
    $("#buscarEstudiante").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: ruta + 'controllers/asistenciaController.php?option=buscarEstudiante',
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
            const id = ui.item.id;
            document.getElementById('buscarEstudiante').value = '';
            window.location = ruta + 'plantilla.php?pagina=verAsistencia&estudiante=' + id;
            return false;
        }
    });

    function salir(params) {
      Snackbar.show({
    text: 'Esta seguro de salir',
    width: '475px',
    actionText: 'Si salir',
    backgroundColor: '#FF0303',
    onActionClick: function (element) {
      axios.get(ruta + 'controllers/usuariosController.php?option=logout')
        .then(function (response) {
          const info = response.data;
          message(info.tipo, info.mensaje);
          if (info.tipo == 'success') {
            setTimeout(() => {
              window.location = ruta;
            }, 1500);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  });
    }
</script>
<?php
if (!empty($_GET['pagina'])) {
    $script = $_GET['pagina'] . '.js';
    if (file_exists('assets/js/' . $script)) {
        echo '<script src="'. RUTA . 'assets/js/' . $script .'"></script>';
    }
}else{
    echo '<script src="'. RUTA . 'assets/js/index.js"></script>';
} ?>
</body>

</html>