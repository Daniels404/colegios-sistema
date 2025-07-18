<?php

require_once __DIR__ . '/../confi/database.php';

class Profesor {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function registrar($datos) {
        // Verificar si ya existe el documento
        $stmtCheck = $this->conn->prepare("SELECT COUNT(*) FROM profesores WHERE documento = :documento");
        $stmtCheck->bindParam(':documento', $datos['documento']);
        $stmtCheck->execute();
        
        if ($stmtCheck->fetchColumn() > 0) {
            return ['error' => 'Ya existe un profesor con este documento.'];
        }

        $stmt = $this->conn->prepare("INSERT INTO profesores (nombre, documento, contacto, correo, rh, numero_estudiantes, jornada, materia_id)
                                      VALUES (:nombre, :documento, :contacto, :correo, :rh, :numero_estudiantes, :jornada, :materia_id)");

        $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':documento' => $datos['documento'],
            ':contacto' => $datos['contacto'],
            ':correo' => $datos['correo'],
            ':rh' => $datos['rh'],
            ':numero_estudiantes' => $datos['numero_estudiantes'],
            ':jornada' => $datos['jornada'],
            ':materia_id' => $datos['materia_id']
        ]);

        return ['success' => true];
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

    public function actualizar($id, $data) {
        $sql = "UPDATE profesores SET 
                    nombre = :nombre,
                    documento = :documento,
                    contacto = :contacto,
                    correo = :correo,
                    rh = :rh,
                    numero_estudiantes = :numero_estudiantes,
                    jornada = :jornada,
                    materia_id = :materia_id
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function existeDocumento($documento, $excluirId = null) {
        $sql = "SELECT COUNT(*) FROM profesores WHERE documento = :documento";
        $params = [':documento' => $documento];
        if ($excluirId) {
            $sql .= " AND id != :id";
            $params[':id'] = $excluirId;
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }


    public function buscarPorId($id) {
        $sql = "SELECT * FROM profesores WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}