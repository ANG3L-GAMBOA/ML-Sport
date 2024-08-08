<?php
require_once '../config.php';
require_once 'conexion.php';
class EstudiantesModel{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion();
        $this->pdo = $this->con->conectar();
    }

    public function getEstudiantes()
    {
        $consult = $this->pdo->prepare("SELECT e.*, c.nombre AS carrera, n.nombre AS nivel FROM estudiantes e INNER JOIN carreras c ON e.id_carrera = c.id INNER JOIN niveles n ON e.id_nivel = n.id WHERE e.estado = 1");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDatos($table)
    {
        $consult = $this->pdo->prepare("SELECT * FROM $table WHERE estado = ?");
        $consult->execute([1]);
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEstudiante($id)
    {
        $consult = $this->pdo->prepare("SELECT * FROM estudiantes WHERE id = ?");
        $consult->execute([$id]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function comprobarCodigo($codigo, $accion)
    {
        if ($accion == 0) {
            $consult = $this->pdo->prepare("SELECT * FROM estudiantes WHERE codigo = ?");
            $consult->execute([$codigo]);
        } else {
            $consult = $this->pdo->prepare("SELECT * FROM estudiantes WHERE codigo = ? AND id != ?");
            $consult->execute([$codigo, $accion]);
        }
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function save($codigo, $nombre, $apellido, $telefono, $direccion, $carrera,$nivel)
    {
        $consult = $this->pdo->prepare("INSERT INTO estudiantes (codigo, nombre, apellido, telefono, direccion, id_carrera, id_nivel) VALUES (?,?,?,?,?,?,?)");
        return $consult->execute([$codigo, $nombre, $apellido, $telefono, $direccion, $carrera,$nivel]);
    }

    public function delete($id)
    {
        $consult = $this->pdo->prepare("UPDATE estudiantes SET estado = ? WHERE id = ?");
        return $consult->execute([0, $id]);
    }

    public function update($codigo, $nombre, $apellido, $telefono, $direccion, $carrera,$nivel, $id)
    {
        $consult = $this->pdo->prepare("UPDATE estudiantes SET codigo=?, nombre=?, apellido=?, telefono=?, direccion=?, id_carrera=?, id_nivel=? WHERE id=?");
        return $consult->execute([$codigo, $nombre, $apellido, $telefono, $direccion, $carrera,$nivel, $id]);
    }
}
