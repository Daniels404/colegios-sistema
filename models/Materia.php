<?php
require_once 'Confi/Database.php';

class Materia {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection(); // ✅ Usa la conexión estática correctamente
    }

    public function obtenerTodas() {
        $stmt = $this->db->query("SELECT * FROM materias");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function asignarAMaestro($materia_id, $profesor_id) {
        $stmt = $this->db->prepare("INSERT INTO materia_profesor (materia_id, profesor_id) VALUES (:materia_id, :profesor_id)");
        $stmt->bindParam(':materia_id', $materia_id);
        $stmt->bindParam(':profesor_id', $profesor_id);
        $stmt->execute();
    }

public function obtenerTodasConProfesor() {
    $db = Database::getConnection();
    $stmt = $db->query("
        SELECT 
            m.id, 
            m.nombre AS materia, 
            p.nombre AS profesor, 
            p.documento
        FROM materias m
        LEFT JOIN materia_profesor mp ON m.id = mp.materia_id
        LEFT JOIN profesores p ON mp.profesor_id = p.id
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function buscarPorId($id) {
    $stmt = $this->db->prepare("SELECT * FROM materias WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
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