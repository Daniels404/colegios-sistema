<?php
require_once __DIR__ . '/../confi/database.php';

class Profesor {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function registrar($data) {
        $sql = "INSERT INTO profesores (nombre, documento, contacto, correo, rh, numero_estudiantes, jornada, materia_id)
                VALUES (:nombre, :documento, :contacto, :correo, :rh, :numero_estudiantes, :jornada, :materia_id)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function obtenerTodos() {
        $sql = "SELECT p.*, m.nombre AS materia
                FROM profesores p
                LEFT JOIN materias m ON p.materia_id = m.id";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contar() {
    $stmt = $this->conn->query("SELECT COUNT(*) as total FROM profesores");
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}


public function obtenerUltimoId() {
    return $this->conn->lastInsertId();
}



}
