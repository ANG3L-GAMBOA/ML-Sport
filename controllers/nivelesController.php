<?php
require_once '../models/niveles.php';
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
$niveles = new NivelesModel();
switch ($option) {
    case 'listar':
        $data = $niveles->getNiveles();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="d-flex">
                <a class="btn btn-danger btn-sm" onclick="eliminar(' . $data[$i]['id'] . ')"><i class="fas fa-eraser"></i></a>
                <a class="btn btn-primary btn-sm" onclick="edit(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></a>
            </div>';
        }
        echo json_encode($data);
        break;
    case 'save':
        $nombre = $_POST['nombre'];
        $id_nivel = $_POST['id_nivel'];
        if ($id_nivel == '') {
            $consult = $niveles->comprobarNombre($nombre, 0);
            if (empty($consult)) {
                $result = $niveles->save($nombre);
                if ($result) {
                    $res = array('tipo' => 'success', 'mensaje' => 'NIVEL REGISTRADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'EL NIVEL YA EXISTE');
            }
        } else {
            $consult = $niveles->comprobarNombre($nombre, $id_nivel);
            if (empty($consult)) {
                $result = $niveles->update($nombre, $id_nivel);
                if ($result) {
                    $res = array('tipo' => 'success', 'mensaje' => 'NIVEL MODIFICADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL MODIFICAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'EL NIVEL YA EXISTE');
            }
        }
        echo json_encode($res);
        break;
    case 'delete':
        $id = $_GET['id'];
        $data = $niveles->delete($id);
        if ($data) {
            $res = array('tipo' => 'success', 'mensaje' => 'NIVEL ELIMINADO');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL ELIMINAR');
        }
        echo json_encode($res);
        break;
    case 'edit':
        $id = $_GET['id'];
        $data = $niveles->getNivel($id);
        echo json_encode($data);
        break;
    default:
        # code...
        break;
}
