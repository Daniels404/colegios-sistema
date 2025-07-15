<?php

class Rol {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection(); // Asegúrate de tener esta clase también incluida
    }

    public function obtenerTodos() {
        $stmt = $this->conn->query("SELECT * FROM roles");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
