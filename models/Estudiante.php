<?php
require_once 'confi/database.php';

class Estudiante {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function obtenerTodos() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM estudiantes");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener estudiantes: " . $e->getMessage());
            return [];
        }
    }

    public function obtenerTodosConColegios() {
        try {
            $sql = "SELECT e.*, c.nombre AS colegio_nombre
                    FROM estudiantes e
                    LEFT JOIN colegios c ON e.colegio_id = c.id";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener estudiantes con colegios: " . $e->getMessage());
            return [];
        }
    }

    public function obtenerPorId($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM estudiantes WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener estudiante por ID: " . $e->getMessage());
            return null;
        }
    }

    public function insertar($data) {
        try {
            $sql = "INSERT INTO estudiantes 
                        (nombre, ficha, nombre_alumno, documento_estudiante, grado, colegio_id) 
                    VALUES 
                        (:nombre, :ficha, :nombre_alumno, :documento_estudiante, :grado, :colegio_id)";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':ficha', $data['ficha']);
            $stmt->bindParam(':nombre_alumno', $data['nombre_alumno']);
            $stmt->bindParam(':documento_estudiante', $data['documento_estudiante']);
            $stmt->bindParam(':grado', $data['grado']);
            $stmt->bindParam(':colegio_id', $data['colegio_id']);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al insertar estudiante: " . $e->getMessage());
            return false;
        }
    }

    public function registrar($data) {
        try {
            $sql = "INSERT INTO estudiantes (
                        nombre, ficha, nombre_alumno, documento_estudiante, grado, tipo_documento,
                        direccion, numero_contacto, correo, correo_inst, jornada, dias,
                        colegio, rector, observaciones, colegio_id, rh
                    ) VALUES (
                        :nombre, :ficha, :nombre_alumno, :documento_estudiante, :grado, :tipo_documento,
                        :direccion, :numero_contacto, :correo, :correo_inst, :jornada, :dias,
                        :colegio, :rector, :observaciones, :colegio_id, :rh
                    )";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($data);
        } catch (PDOException $e) {
            error_log("Error al registrar estudiante: " . $e->getMessage());
            return false;
        }
    }

    public function actualizar($id, $data) {
        try {
            $sql = "UPDATE estudiantes SET
                        nombre = :nombre,
                        ficha = :ficha,
                        nombre_alumno = :nombre_alumno,
                        documento_estudiante = :documento_estudiante,
                        grado = :grado,
                        tipo_documento = :tipo_documento,
                        direccion = :direccion,
                        numero_contacto = :numero_contacto,
                        correo = :correo,
                        correo_inst = :correo_inst,
                        jornada = :jornada,
                        dias = :dias,
                        colegio = :colegio,
                        rector = :rector,
                        observaciones = :observaciones,
                        colegio_id = :colegio_id,
                        rh = :rh
                    WHERE id = :id";
            $data['id'] = $id;
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($data);
        } catch (PDOException $e) {
            error_log("Error al actualizar estudiante: " . $e->getMessage());
            return false;
        }
    }

    public function actualizarDatosContacto($id, $data) {
        try {
            $sql = "UPDATE estudiantes SET
                        numero_contacto = :numero_contacto,
                        correo = :correo,
                        direccion = :direccion,
                        jornada = :jornada,
                        observaciones = :observaciones
                    WHERE id = :id";
            $data['id'] = $id;
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($data);
        } catch (PDOException $e) {
            error_log("Error al actualizar datos de contacto: " . $e->getMessage());
            return false;
        }
    }

    public function eliminar($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM estudiantes WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar estudiante: " . $e->getMessage());
            return false;
        }
    }

    public function contarEstudiantes() {
        try {
            $stmt = $this->conn->query("SELECT COUNT(*) as total FROM estudiantes");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return isset($result['total']) ? (int)$result['total'] : 0;
        } catch (PDOException $e) {
            error_log("Error al contar estudiantes: " . $e->getMessage());
            return 0;
        }
    }
}
