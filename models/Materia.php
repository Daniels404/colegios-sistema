<?php
require_once __DIR__ . '/../confi/database.php';

class Materia {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function registrar($data) {
        $sql = "INSERT INTO materias (nombre, profesor_id) VALUES (:nombre, :profesor_id)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function obtenerTodasConProfesor() {
        $sql = "SELECT m.id, m.nombre AS materia, p.nombre AS profesor
                FROM materias m
                LEFT JOIN profesores p ON m.profesor_id = p.id";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
    //public function buscarPorId($id) {
        //$stmt = $this->conn->prepare("SELECT * FROM materias WHERE id = :id");
       // $stmt->bindParam(':id', $id);
       // $stmt->execute();
        //return $stmt->fetch(PDO::FETCH_ASSOC);
    //}

    //public function actualizar($id, $data) {
      //  $sql = "UPDATE materias SET nombre = :nombre, profesor_id = :profesor_id WHERE id = :id";
        //$stmt = $this->conn->prepare($sql);
        //return $stmt->execute([
          //  ':nombre' => $data['nombre'],
            //':profesor_id' => $data['profesor_id'],
            //':id' => $id
        //]);
    //}
//}