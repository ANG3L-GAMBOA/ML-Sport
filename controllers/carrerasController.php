<?php
require_once '../models/carreras.php';
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
$carreras = new CarrerasModel();
switch ($option) {
    case 'listar':
        $data = $carreras->getCarreras();
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
        $id_carrera = $_POST['id_carrera'];
        if ($id_carrera == '') {
            $consult = $carreras->comprobarNombre($nombre, 0);
            if (empty($consult)) {
                $result = $carreras->save($nombre);
                if ($result) {
                    $res = array('tipo' => 'success', 'mensaje' => 'CARRERA REGISTRADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'EL CARRERA YA EXISTE');
            }
        } else {
            $consult = $carreras->comprobarNombre($nombre, $id_carrera);
            if (empty($consult)) {
                $result = $carreras->update($nombre, $id_carrera);
                if ($result) {
                    $res = array('tipo' => 'success', 'mensaje' => 'CARRERA MODIFICADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL MODIFICAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'EL CARRERA YA EXISTE');
            }
        }
        echo json_encode($res);
        break;
    case 'delete':
        $id = $_GET['id'];
        $data = $carreras->delete($id);
        if ($data) {
            $res = array('tipo' => 'success', 'mensaje' => 'CARRERA ELIMINADO');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL ELIMINAR');
        }
        echo json_encode($res);
        break;
    case 'edit':
        $id = $_GET['id'];
        $data = $carreras->getCarrera($id);
        echo json_encode($data);
        break;
    default:
        # code...
        break;
}
