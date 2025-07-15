<?php
require_once 'models/Usuario.php';

class UsuarioController {

    // 🔒 Solo el admin puede acceder al registro de usuarios
    public function mostrarFormularioRegistro() {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header('Location: index.php?page=dashboard');
            exit;
        }

        $usuarioModel = new Usuario();
        $roles = $usuarioModel->obtenerRoles(); // Lista de roles disponibles
        require 'views/registro_usuario.php';
    }

    // 📝 Procesar registro de usuario nuevo (solo admin)
    public function guardarUsuario() {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header('Location: index.php?page=dashboard');
            exit;
        }

        $usuarioModel = new Usuario();

        $data = [
            'usuario' => $_POST['usuario'],
            'clave' => $_POST['clave'],
            'rol_id' => $_POST['rol_id']
        ];

        $usuarioModel->registrar($data);

        $_SESSION['mensaje'] = 'Usuario registrado exitosamente.';
        header('Location: index.php?page=usuarios');
        exit;
    }

    // (opcional) Listar todos los usuarios (admin)
    public function listarUsuarios() {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header('Location: index.php?page=dashboard');
            exit;
        }

        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->obtenerTodosConRol();
        $roles = $usuarioModel->obtenerRoles();
        require 'views/usuarios.php';
    }

    public function aprobarUsuarios() {
        $usuarioModel = new Usuario();

        if (!empty($_POST['usuarios_aprobar']) && !empty($_POST['roles'])) {
            foreach ($_POST['usuarios_aprobar'] as $idUsuario) {
                $rolId = $_POST['roles'][$idUsuario] ?? null;
                if ($rolId) {
                    $usuarioModel->aprobarUsuario($idUsuario, $rolId);
                }
            }
        }

        header("Location: index.php?page=adminUsuariosPendientes");
        exit;
    }

    public function mostrarPendientes() {
        require 'views/admin_usuarios_pendientes.php';
    }

    public function mostrarFormularioRegistroPublico() {
        $usuarioModel = new Usuario();
        $roles = $usuarioModel->obtenerRoles();
        require 'views/registro_nuevo_usuario.php';
    }

    public function guardarRegistroPublico() {
        $usuarioModel = new Usuario();
        $data = [
            'usuario' => $_POST['usuario'],
            'clave' => password_hash($_POST['clave'], PASSWORD_DEFAULT),
            'rol_id' => 2 // Por defecto "usuario" (ajusta si necesitas otro valor)
        ];
        $registroExitoso = $usuarioModel->registrar($data);
        if ($registroExitoso) {
            $_SESSION['mensaje'] = 'Registro enviado. Espera aprobación del administrador.';
            header('Location: index.php?page=login');
            exit;
        } else {
            $_SESSION['login_error'] = 'Error al registrar usuario.';
            header('Location: index.php?page=registro_nuevo_usuario');
            exit;
        }
    }

    public function guardarUsuarioPublico() {
        $usuarioModel = new Usuario();
        $data = [
            'correo'  => $_POST['correo'],
            'clave'   => password_hash($_POST['clave'], PASSWORD_DEFAULT),
            'rol_id'  => $_POST['rol_id'],
            'usuario' => $_POST['correo'],
            'estado'  => 'pendiente'
        ];

        $usuarioModel->registrar($data);
        $_SESSION['mensaje'] = 'Registro enviado. Espera aprobación del administrador.';
        header('Location: index.php?page=login');
        exit;
    }

    // ✅ NUEVO: Ver todos los usuarios (con roles) para admins
    public function mostrarUsuarios() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header('Location: index.php?page=dashboard');
            exit;
        }

        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->obtenerTodosConRol();
        $roles = $usuarioModel->obtenerRoles();

        // Validación extra para evitar errores si no hay roles o usuarios
        if ($usuarios === false || $roles === false) {
            $_SESSION['mensaje'] = 'No se pudieron cargar los usuarios o roles.';
            $usuarios = [];
            $roles = [];
        }

        require 'views/usuarios.php';
    }

    // ✅ NUEVO: Cambiar rol
    public function cambiarRol() {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header('Location: index.php?page=dashboard');
            exit;
        }

        $id = $_POST['id'] ?? null;
        $rol_id = $_POST['rol_id'] ?? null;

        if ($id && $rol_id) {
            $modelo = new Usuario();
            $modelo->cambiarRol($id, $rol_id);
            $_SESSION['mensaje'] = "Rol actualizado correctamente.";
        }

        header("Location: index.php?page=usuarios");
        exit;
    }

    // ✅ NUEVO: Eliminar usuario
    public function eliminarUsuario() {
        session_start();
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header('Location: index.php?page=dashboard');
            exit;
        }

        $id = $_POST['id'] ?? null;

        if ($id) {
            $modelo = new Usuario();
            $modelo->eliminar($id);
            $_SESSION['mensaje'] = "Usuario eliminado.";
        }

        header("Location: index.php?page=usuarios");
        exit;
    }
}
