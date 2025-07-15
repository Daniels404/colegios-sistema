<?php
require_once 'confi/database.php';  // SIEMPRE usar require_once


class Estudiante {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection(); // asegúrate que esta clase existe
    }

public function obtenerTodosConColegios() {
    $sql = "SELECT e.*, c.nombre AS colegio_nombre
            FROM estudiantes e
            LEFT JOIN colegios c ON e.colegio_id = c.id";
    $stmt = $this->conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // ✅ AHORA sí retorna
}

    public function registrar($data) {
        $sql = "INSERT INTO estudiantes (
                    nombre, ficha, nombre_alumno, documento_estudiante, grado, tipo_documento,
                    direccion, numero_contacto, correo, correo_inst, jornada, dias,
                    colegio, rector, observaciones, colegio_id
                ) VALUES (
                    :nombre, :ficha, :nombre_alumno, :documento_estudiante, :grado, :tipo_documento,
                    :direccion, :numero_contacto, :correo, :correo_inst, :jornada, :dias,
                    :colegio, :rector, :observaciones, :colegio_id
                )";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

public function contarEstudiantes() {
    $total = 0; // Inicializamos la variable para evitar el error

    try {
        $stmt = $this->conn->query("SELECT COUNT(*) as total FROM estudiantes");
        if ($stmt) {
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($fila && isset($fila['total'])) {
                $total = (int)$fila['total'];
            }
        }
    } catch (PDOException $e) {
        // Opcional: registrar o mostrar el error
        error_log("Error al contar estudiantes: " . $e->getMessage());
    }

    return $total;
}



}
