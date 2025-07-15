<?php
require_once 'confi/Database.php';  // SIEMPRE usar require_once

class RH {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function obtenerTodos() {
        $stmt = $this->conn->query("SELECT * FROM rh");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
