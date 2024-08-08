<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Control de asistencia</title>
  <!-- base:css -->
  <link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>vendor/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>vendor/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>css/style.css">
  <link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>css/full-calendar.css">
  <link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>vendor/DataTables/datatables.min.css">
  
  <link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>css/snackbar.min.css">
  <link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>css/jquery-ui.min.css">
  
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo RUTA . 'assets/'; ?>images/logo.png" />
</head>
<body>
  <div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item sidebar-category">
          <p>Navigation</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="plantilla.php">
            <i class="mdi mdi-view-quilt menu-icon"></i>
            <span class="menu-title">Dashboard</span>
            <div class="badge badge-info badge-pill">2</div>
          </a>
        </li>
        <li class="nav-item sidebar-category">
          <p>Components</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="mdi mdi-palette menu-icon"></i>
            <span class="menu-title">Administración</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="?pagina=usuarios">Usuarios</a></li>
              <li class="nav-item"> <a class="nav-link" href="?pagina=configuracion">Configuracion</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?pagina=carreras">
            <i class="mdi mdi-view-headline menu-icon"></i>
            <span class="menu-title">Area</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?pagina=niveles">
            <i class="mdi mdi-tag menu-icon"></i>
            <span class="menu-title">Niveles</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?pagina=estudiantes">
            <i class="mdi mdi-chart-pie menu-icon"></i>
            <span class="menu-title">Empleado</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?pagina=asistencia">
            <i class="mdi mdi-calendar menu-icon"></i>
            <span class="menu-title">Asistencia</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="navbar-brand-wrapper">
            <a class="navbar-brand brand-logo" href="plantilla.php"><img src="<?php echo RUTA . 'assets/'; ?>images/logo.png" width="60" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="plantilla.php"><img src="<?php echo RUTA . 'assets/'; ?>images/logo.png" width="30" alt="logo"/></a>
          </div>
          <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1">Bienvenido a sistema de control de asistencia</h4>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item">
              <h4 class="mb-0 font-weight-bold d-none d-xl-block"><?php echo fechaPeru(); ?></h4>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">
          <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
              <div class="input-group">
                <input type="text" id="buscarEstudiante" class="form-control" placeholder="Buscar..." aria-label="search" aria-describedby="search">
              </div>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                <img src="<?php echo RUTA . 'assets/'; ?>images/avatar.png" alt="profile"/>
                <span class="nav-profile-name"><?php echo $_SESSION['nombre']; ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#" onclick="salir()">
                  <i class="mdi mdi-logout text-primary"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
        