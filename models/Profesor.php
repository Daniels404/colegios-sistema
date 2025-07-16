<?php
require_once __DIR__ . '/../confi/database.php';

class Profesor {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function registrar($data) {
        $sql = "INSERT INTO profesores (nombre, documento, contacto, correo, rh, numero_estudiantes, jornada)
                VALUES (:nombre, :documento, :contacto, :correo, :rh, :numero_estudiantes, :jornada)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function obtenerTodos() {
        return $this->conn->query("SELECT * FROM profesores")->fetchAll(PDO::FETCH_ASSOC);
    }
}
