<?php
require_once __DIR__ . '/../confi/database.php';

class Estudiante {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // 🔹 Registrar estudiante
    public function registrar($data) {
        $sql = "INSERT INTO estudiantes (nombre, ficha, nombre_alumno, documento_estudiante, grado, tipo_documento, direccion, numero_contacto, correo, correo_inst, jornada, dias, colegio, rector, observaciones, colegio_id)
                VALUES (:nombre, :ficha, :nombre_alumno, :documento_estudiante, :grado, :tipo_documento, :direccion, :numero_contacto, :correo, :correo_inst, :jornada, :dias, :colegio, :rector, :observaciones, :colegio_id)";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nombre' => $data['nombre'],
            ':ficha' => $data['ficha'],
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
            ':rector' => $data['rector'],
            ':observaciones' => $data['observaciones'],
            ':colegio_id' => $data['colegio_id'],
        ]);
    }

    // 🔹 Buscar estudiante por ID con nombre del colegio
    public function buscarPorIdConColegio($id) {
        $sql = "SELECT e.*, c.nombre AS colegio_nombre
                FROM estudiantes e
                LEFT JOIN colegios c ON e.colegio_id = c.id
                WHERE e.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Listado con colegio
    public function obtenerTodosConColegios() {
        $sql = "SELECT e.*, c.nombre AS colegio_nombre
                FROM estudiantes e
                LEFT JOIN colegios c ON e.colegio_id = c.id";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarEstudiantes() {
    $sql = "SELECT COUNT(*) as total FROM estudiantes";
    $stmt = $this->conn->query($sql);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultado['total'] ?? 0;
}

}
