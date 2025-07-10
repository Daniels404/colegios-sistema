<?php
require_once __DIR__ . '/../config/database.php';

class Estudiante {
    private $conn;
    private $table = "estudiantes";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function registrar($data) {
        $query = "INSERT INTO " . $this->table . " 
            (nombre, ficha, rector, nombre_alumno, documento_estudiante, grado, tipo_documento, direccion, numero_contacto, correo, correo_inst, jornada, dias, colegio, observaciones)
            VALUES 
            (:nombre, :ficha, :rector, :nombre_alumno, :documento_estudiante, :grado, :tipo_documento, :direccion, :numero_contacto, :correo, :correo_inst, :jornada, :dias, :colegio, :observaciones)";
        
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':nombre' => $data['nombre'],
            ':ficha' => $data['ficha'],
            ':rector' => $data['rector'],
            ':nombre_alumno' => $data['nombre_alumno'],
            ':documento_estudiante' => $data['documento_estudiante'],
            ':grado' => $data['grado'],
            ':tipo_documento' => $data['tipo_documento'],
            ':direccion' => $data['direccion'],
            ':numero_contacto' => $data['numero_contacto'],
            ':correo' => $data['correo'],
            ':correo_inst' => $data['correo_inst'],
            ':jornada' => $data['jornada'],
            ':dias' => $data['dias'],
            ':colegio' => $data['colegio'],
            ':observaciones' => $data['observaciones']
        ]);
    }

    public function obtenerTodos() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY fecha_registro DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($id) {
        $db = Database::getConnection();
        $sql = "SELECT * FROM estudiantes WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

  public static function actualizar($id, $datos) {
    $db = Database::getConnection();
    $sql = "UPDATE estudiantes SET 
        nombre = ?, ficha = ?, rector = ?, nombre_alumno = ?, 
        documento_estudiante = ?, grado = ?, tipo_documento = ?, 
        direccion = ?, numero_contacto = ?, correo = ?, 
        correo_inst = ?, jornada = ?, dias = ?, colegio = ?, 
        observaciones = ?
        WHERE id = ?";
    $stmt = $db->prepare($sql);
    return $stmt->execute([
        $datos['nombre'], $datos['ficha'], $datos['rector'], $datos['nombre_alumno'],
        $datos['documento_estudiante'], $datos['grado'], $datos['tipo_documento'],
        $datos['direccion'], $datos['numero_contacto'], $datos['correo'],
        $datos['correo_inst'], $datos['jornada'], $datos['dias'], $datos['colegio'],
        $datos['observaciones'], $id
    ]);
}



    public static function eliminar($id) {
        $db = Database::getConnection();
        $sql = "DELETE FROM estudiantes WHERE id = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$id]);
    }
}
