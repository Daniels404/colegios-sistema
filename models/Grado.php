<?php
require_once 'confi/Database.php'; // ✅ Solo una vez, fuera de la clase

class Grado {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection(); // ✅ conexión guardada
    }

    public function obtenerTodos() {
        $stmt = $this->pdo->query("SELECT * FROM grados"); // ✅ usamos $this->pdo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
