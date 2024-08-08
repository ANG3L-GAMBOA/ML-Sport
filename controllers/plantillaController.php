<?php
class Plantilla{
    ###### pagina login ######
    public function login()
    {
        include_once 'views/login.php';
    }
    ###### pagina principal ######
    public function index()
    {
        include_once 'views/principal.php';
    }
    ###### pagina estudiantes #####
    public function estudiantes()
    {
        include_once 'views/estudiantes/index.php';
    }
    public function niveles()
    {
        include_once 'views/estudiantes/nivel.php';
    }
    public function carreras()
    {
        include_once 'views/estudiantes/carrera.php';
    }
    ###### pagina asistencia #####
    public function asistencia()
    {
        include_once 'views/asistencia/index.php';
    }
    public function ver()
    {
        include_once 'views/asistencia/ver.php';
    }
    public function verAsistencia()
    {
        include_once 'views/asistencia/verAsistencia.php';
    }
    ###### pagina usuarios ######
    public function usuarios()
    {
        include_once 'views/usuarios/index.php';
    }
    ###### pagina configuracion ######
    public function configuracion()
    {
        include_once 'views/usuarios/configuracion.php';
    }
    ###### PAGINA DE ERRROR ######
    public function notFound()
    {
        include_once 'views/errors.php';
    }

}
?>