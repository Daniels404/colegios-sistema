<?php
require_once 'confi/database.php';  // SIEMPRE usar require_once


class TipoDocumento {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function obtenerTodos() {
        $stmt = $this->conn->query("SELECT * FROM tipos_documento");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
