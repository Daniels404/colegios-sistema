<?php
require_once __DIR__ . '/../confi/database.php'; // Asegúrate que esta ruta sea correcta

class Colegio {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection(); // 💡 Conexión a la BD
    }

    // 🔹 Registrar un colegio
    public function registrar($data) {
        $sql = "INSERT INTO colegios (nombre, tipo, direccion, contacto, rector)
                VALUES (:nombre, :tipo, :direccion, :contacto, :rector)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nombre'   => $data['nombre'],
            ':tipo'     => $data['tipo'],
            ':direccion'=> $data['direccion'],
           ':contacto' => $data['contacto'],

            ':rector'   => $data['rector'],
        ]);
    }

    // 🔹 Buscar todos los colegios
   public function obtenerTodos() {
    $stmt = $this->conn->query("SELECT * FROM colegios");
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // ✅ IMPORTANTE: return aquí
}


    // 🔹 Buscar colegio por ID
    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM colegios WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Actualizar colegio
    public function actualizar($id, $data) {
        $sql = "UPDATE colegios SET nombre = :nombre, tipo = :tipo, direccion = :direccion, contacto = :contacto, rector = :rector
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nombre'   => $data['nombre'],
            ':tipo'     => $data['tipo'],
            ':direccion'=> $data['direccion'],
          ':contacto' => $data['contacto'],

            ':rector'   => $data['rector'],
            ':id'       => $id
        ]);
    }

    // 🔹 Eliminar colegio
    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM colegios WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function contarTodos() {
    $stmt = $this->conn->query("SELECT COUNT(*) as total FROM colegios");
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultado['total'] ?? 0;
}



}
