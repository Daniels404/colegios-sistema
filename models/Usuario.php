<?php
require_once __DIR__ . '/../confi/database.php';

class Usuario {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // 🔐 Login con verificación de contraseña
    public function autenticar($usuario, $clave) {
        $sql = "SELECT u.*, r.nombre AS rol_nombre 
                FROM usuarios u
                JOIN roles r ON u.rol_id = r.id
                WHERE u.usuario = :usuario";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':usuario' => $usuario]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($clave, $usuario['clave'])) {
            return $usuario;
        }

        return null;
    }

    // ➕ Registrar usuario (admin asigna el rol)

public function registrar($data) {
    $sql = "INSERT INTO usuarios (usuario, clave, rol_id, correo, estado)
            VALUES (:usuario, :clave, :rol_id, :correo, :estado)";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        ':usuario' => $data['usuario'],
        ':clave'   => $data['clave'],
        ':rol_id'  => $data['rol_id'],
        ':correo'  => $data['correo'] ?? null,
        ':estado'  => $data['estado'] ?? 'pendiente'
    ]);
}


    // 🔍 Listar todos los usuarios
    public function obtenerTodos() {
        $sql = "SELECT u.id, u.usuario, r.nombre AS rol
                FROM usuarios u
                JOIN roles r ON u.rol_id = r.id";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔧 Cambiar rol de un usuario
    public function cambiarRol($usuarioId, $nuevoRolId) {
        $sql = "UPDATE usuarios SET rol_id = :rol_id WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':rol_id' => $nuevoRolId,
            ':id'     => $usuarioId
        ]);
    }

    // ❌ Eliminar usuario
    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function obtenerRoles() {
    $stmt = $this->conn->query("SELECT * FROM roles");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Obtener usuarios pendientes
public function obtenerPendientes() {
    $stmt = $this->conn->query("SELECT * FROM usuarios WHERE estado = 'pendiente'");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Aprobar usuario y asignar rol
public function aprobarUsuario($id, $rol_id) {
    $sql = "UPDATE usuarios SET estado = 'aprobado', rol_id = :rol_id WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        ':rol_id' => $rol_id,
        ':id'     => $id
    ]);
}


public function obtenerTodosConRol() {
    $stmt = $this->conn->query("
        SELECT u.id, u.usuario, r.nombre AS rol 
        FROM usuarios u
        LEFT JOIN roles r ON u.rol_id = r.id
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}
