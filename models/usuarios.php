<?php
require_once '../config.php';
require_once 'conexion.php';
class UsuariosModel{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion();
        $this->pdo = $this->con->conectar();
    }

    public function getUsers()
    {
        $consult = $this->pdo->prepare("SELECT * FROM usuario WHERE estado = 1");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUser($id)
    {
        $consult = $this->pdo->prepare("SELECT * FROM usuario WHERE idusuario = ?");
        $consult->execute([$id]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function comprobarCorreo($correo)
    {
        $consult = $this->pdo->prepare("SELECT * FROM usuario WHERE correo = ? AND estado = 1");
        $consult->execute([$correo]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function saveUser($nombre, $correo, $clave, $direccion)
    {
        $consult = $this->pdo->prepare("INSERT INTO usuario (nombre, correo, clave, direccion) VALUES (?,?,?,?)");
        return $consult->execute([$nombre, $correo, $clave, $direccion]);
    }

    public function deleteUser($id)
    {
        $consult = $this->pdo->prepare("UPDATE usuario SET estado = ? WHERE idusuario = ?");
        return $consult->execute([0, $id]);
    }

    public function updateUser($nombre, $correo, $direccion, $id)
    {
        $consult = $this->pdo->prepare("UPDATE usuario SET nombre=?, correo=?, direccion=? WHERE idusuario=?");
        return $consult->execute([$nombre, $correo, $direccion, $id]);
    }
}

?>