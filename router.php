<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Páginas permitidas sin iniciar sesión
$paginas_sin_login = [
    'login',
    'procesar_login',
    'registro',
    'guardar',
    'registroNuevoUsuario',
    'registro_usuario_publico',
    'guardar_usuario_publico'
];

// Obtener página solicitada o por defecto

$route = $_GET['page'] ?? 'login';

// Validación de sesión
if (!isset($_SESSION['usuario']) && !in_array($route, $paginas_sin_login)) {
    header("Location: index.php?page=login");
    exit;
}

// Enrutador principal
switch ($route) {

    case 'usuarios':
        require_once 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->mostrarUsuarios();
        break;

    case 'registro':
        require_once 'controllers/EstudianteController.php';
        $controller = new EstudianteController();
        $controller->crear(); // Cambiado a crear()
        break;

    case 'guardar':
        require_once 'controllers/EstudianteController.php';
        $controller = new EstudianteController();
        $controller->guardar();
        break;

    case 'listado_estudiantes':
            require_once 'controllers/EstudianteController.php';
            $controller = new EstudianteController();
       
            $controller->index(); 
            break;
        

    case 'login':
        require_once 'views/login.php';
        break;

    case 'procesar_login':
        require_once 'Confi/Database.php';
        $conn = (new Database())->getConnection();

        $correo = $_POST['correo'] ?? '';
        $clave = $_POST['clave'] ?? '';

        $stmt = $conn->prepare("SELECT u.*, r.nombre as rol FROM usuarios u JOIN roles r ON u.rol_id = r.id WHERE u.correo = :correo LIMIT 1");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && (password_verify($clave, $user['clave']) || $user['clave'] === $clave)) {
            $_SESSION['usuario'] = $user['usuario'];
            $_SESSION['rol'] = $user['rol'];
            header("Location: index.php?page=dashboard");
        } else {
            $_SESSION['login_error'] = "Usuario o contraseña incorrectos.";
            header("Location: index.php?page=login");
        }
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php?page=login");
        break;

    case 'dashboard':
        require_once 'controllers/EstudianteController.php';
        require_once 'controllers/ColegioController.php';
        require_once 'models/Usuario.php';
        require_once 'models/Profesor.php';
        $profesorModel = new Profesor();
        $totalProfesores = $profesorModel->contar();

        $controllerEst = new EstudianteController();
        $controllerCol = new ColegioController();
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->obtenerTodos();

        $total = $controllerEst->contarEstudiantes();
        $totalColegios = $controllerCol->contarColegios();
        $colegios = $controllerCol->obtenerTodos();

        require_once 'views/dashboard.php';
        break;

    case 'preregistro':
        require_once 'controllers/ColegioController.php';
        $controller = new ColegioController();
        $controller->mostrarFormulario();
        break;

    case 'registrar_colegio':
        require_once 'controllers/ColegioController.php';
        $controller = new ColegioController();
        $controller->mostrarFormularioRegistro();
        break;

    case 'guardar_colegio':
        require_once 'controllers/ColegioController.php';
        $controller = new ColegioController();
        $controller->guardar();
        break;

    case 'adminUsuariosPendientes':
        require 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->mostrarPendientes();
        break;

    case 'aprobarUsuarios':
        require 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->aprobarUsuarios();
        break;

    case 'registroNuevoUsuario':
        require 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->mostrarFormularioRegistroPublico();
        break;

    case 'registro_usuario_publico':
        require 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->mostrarFormularioRegistroPublico();
        break;

    case 'guardar_usuario_publico':
        require 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->guardarUsuarioPublico();
        break;

    case 'cambiar_rol':
        require_once 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->cambiarRol();
        break;

    case 'eliminar_usuario':
        require_once 'controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->eliminarUsuario();
        break;

    // PROFESORES
    case 'profesores':
        require_once 'controllers/ProfesorController.php';
        $controller = new ProfesorController();
        $controller->listar();
        break;

    case 'registro_profesor':
        require_once 'controllers/ProfesorController.php';
        $controller = new ProfesorController();
        $controller->mostrarFormulario();
        break;

    case 'guardar_profesor':
        require_once 'controllers/ProfesorController.php';
        $controller = new ProfesorController();
        $controller->guardar();
        break;

    // MATERIAS
    case 'materias':
        require_once 'controllers/MateriaController.php';
        $controller = new MateriaController();
        $controller->listar();
        break;

    case 'registro_materia':
        require_once 'controllers/MateriaController.php';
        $controller = new MateriaController();
        $controller->mostrarFormulario();
        break;

    case 'guardar_materia':
        require_once 'controllers/MateriaController.php';
        $controller = new MateriaController();
        $controller->guardar();
        break;

    default:
        echo "Página no encontrada";
        break;
}