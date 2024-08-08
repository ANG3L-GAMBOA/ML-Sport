<?php
require_once '../models/estudiantes.php';
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
$estudiantes = new EstudiantesModel();
switch ($option) {
    case 'listar':
        $data = $estudiantes->getEstudiantes();
        for ($i = 0; $i < count($data); $i++) {
            $colorNivel = substr(md5($data[$i]['id_nivel']), 0, 6);
            $colorCarrera = substr(md5($data[$i]['id_carrera']), 0, 6);
            $data[$i]['nombres'] = $data[$i]['nombre'] . ' ' . $data[$i]['apellido'];
            $data[$i]['carreras'] = '<span class="badge mx-1" style="background: #'.$colorCarrera.';">'.$data[$i]['carrera'].'</span>';
            $data[$i]['niveles'] = '<span class="badge mx-1" style="background: #'.$colorNivel.';">'.$data[$i]['nivel'].'</span>';
            $data[$i]['accion'] = '<div class="d-flex">
                <a class="btn btn-danger btn-sm" onclick="deleteEst(' . $data[$i]['id'] . ')"><i class="fas fa-eraser"></i></a>
                <a class="btn btn-primary btn-sm" onclick="editEst(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></a>
                </div>';
        }
        echo json_encode($data);
        break;
    case 'save':
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $carrera = $_POST['carrera'];
        $nivel = $_POST['nivel'];
        $id_estudiante = $_POST['id_estudiante'];
        if ($id_estudiante == '') {
            $consult = $estudiantes->comprobarCodigo($codigo, 0);
            if (empty($consult)) {
                $result = $estudiantes->save($codigo, $nombre, $apellido, $telefono, $direccion, $carrera, $nivel);
                if ($result) {
                    $res = array('tipo' => 'success', 'mensaje' => 'ESTUDIANTE REGISTRADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'EL CODIGO YA EXISTE');
            }
        } else {
            $consult = $estudiantes->comprobarCodigo($codigo, $id_estudiante);
            if (empty($consult)) {
                $result = $estudiantes->update($codigo, $nombre, $apellido, $telefono, $direccion, $carrera, $nivel, $id_estudiante);
                if ($result) {
                    $res = array('tipo' => 'success', 'mensaje' => 'ESTUDIANTE MODIFICADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL MODIFICAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'EL CODIGO YA EXISTE');
            }
        }
        echo json_encode($res);
        break;
    case 'delete':
        $id = $_GET['id'];
        $data = $estudiantes->delete($id);
        if ($data) {
            $res = array('tipo' => 'success', 'mensaje' => 'ESTUDIANTE ELIMINADO');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL ELIMINAR');
        }
        echo json_encode($res);
        break;
    case 'edit':
        $id = $_GET['id'];
        $data = $estudiantes->getEstudiante($id);
        echo json_encode($data);
        break;
    case 'datos':
        $item = $_GET['item'];
        $data = $estudiantes->getDatos($item);
        echo json_encode($data);
        break;
    default:
        # code...
        break;
}
