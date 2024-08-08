<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../models/usuarios.php';
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
$usuarios = new UsuariosModel();
switch ($option) {
    case 'acceso':
        $accion = file_get_contents('php://input');
        $array = json_decode($accion, true);
        $email = $array['email'];
        $password = $array['password'];
        $result = $usuarios->comprobarCorreo($email);
        if (empty($result)) {
            $res = array('tipo' => 'error', 'mensaje' => 'EMAIL NO EXISTE');
        } else {
            if (password_verify($password, $result['clave'])) {
                $_SESSION['nombre'] = $result['nombre'];
                $_SESSION['correo'] = $result['correo'];
                $_SESSION['idusuario'] = $result['idusuario'];
                $perfil = (empty($result['perfil'])) ? 'assets/img/avatar.png' : $result['perfil'];
                $_SESSION['perfil'] = $perfil;
                $res = array('tipo' => 'success', 'mensaje' => 'ok');
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'CONTRASEÑA INCORRECTA');
            }
        }
        echo json_encode($res);
        break;
    case 'listar':
        $data = $usuarios->getUsers();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="d-flex">
                <a class="btn btn-danger btn-sm" onclick="deleteUser(' . $data[$i]['idusuario'] . ')"><i class="fas fa-eraser"></i></a>
                <a class="btn btn-primary btn-sm" onclick="editUser(' . $data[$i]['idusuario'] . ')"><i class="fas fa-edit"></i></a>
                </div>';            
        }
        echo json_encode($data);
        break;
    case 'save':
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $direccion = $_POST['direccion'];
        $clave = $_POST['clave'];
        $id_user = $_POST['id_user'];
        if ($id_user == '') {
            $consult = $usuarios->comprobarCorreo($correo);
            if (empty($consult)) {
                $hash = password_hash($clave, PASSWORD_DEFAULT);
                $result = $usuarios->saveUser($nombre, $correo, $hash, $direccion);
                if ($result) {
                    $res = array('tipo' => 'success', 'mensaje' => 'USUARIO REGISTRADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'EL CORREO YA EXISTE');
            }
        } else {
            $result = $usuarios->updateUser($nombre, $correo, $direccion, $id_user);
            if ($result) {
                $res = array('tipo' => 'success', 'mensaje' => 'USUARIO MODIFICADO');
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL MODIFICAR');
            }
        }
        echo json_encode($res);
        break;
    case 'delete':
        $id = $_GET['id'];
        $data = $usuarios->deleteUser($id);
        if ($data) {
            $res = array('tipo' => 'success', 'mensaje' => 'USUARIO ELIMINADO');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL ELIMINAR');
        }
        echo json_encode($res);
        break;
    case 'edit':
        $id = $_GET['id'];
        $data = $usuarios->getUser($id);
        echo json_encode($data);
        break;
    case 'logout':
        session_destroy();
        if (empty($_SESSION)) {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL SALIR');
        } else {
            $res = array('tipo' => 'success', 'mensaje' => 'OK');
        }
        echo json_encode($res);        
        break;
    default:
        # code...
        break;
}
