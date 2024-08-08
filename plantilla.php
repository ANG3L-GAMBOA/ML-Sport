<?php
require_once 'config.php';
require_once 'controllers/plantillaController.php';
$plantilla = new Plantilla();

$archivo = (!empty($_GET['pagina'])) ? $_GET['pagina'] : null;
if ($archivo == 'login' && $archivo != null) {
    $plantilla->login();
    exit;
}

##### PERMISOS #####
$id_user = $_SESSION['idusuario'];
if (empty($id_user)) {
    header('Location: ./');
}

##### HEADER ####
require_once 'views/includes/header.php';

if (isset($_GET['pagina'])) {
    if (empty($_GET['pagina'])) {
        $plantilla->index();
    } else {
        try {
            $archivo = $_GET['pagina'];
            if ($archivo == 'usuarios') {
                $plantilla->usuarios();
            } else if ($archivo == 'configuracion') {
                $plantilla->configuracion();
            } else if ($archivo == 'estudiantes') {
                $plantilla->estudiantes();
            } else if ($archivo == 'niveles') {
                $plantilla->niveles();
            } else if ($archivo == 'carreras') {
                $plantilla->carreras();
            } else if ($archivo == 'asistencia') {
                $plantilla->asistencia();
            } else if ($archivo == 'ver' && !empty($_GET['nivel'])) {
                $plantilla->ver();
            } else if ($archivo == 'verAsistencia' && !empty($_GET['estudiante'])) {
                $plantilla->verAsistencia();
            } else {
                $plantilla->notFound();
            }
        } catch (PDOException $th) {
            $plantilla->notFound();
        }
    }
} else {
    $plantilla->index();
}
require_once 'views/includes/footer.php';

function fechaPeru()
{
    $mes = array(
        "", "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
    );
    return date('d') . " de " . $mes[date('n')] . " de " . date('Y');
}
