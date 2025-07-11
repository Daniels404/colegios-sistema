<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // 🟢 Iniciar sesión si no está activa
}

// ✅ Páginas permitidas sin iniciar sesión
$paginas_sin_login = ['login', 'procesar_login', 'registro', 'guardar'];

// ✅ Obtener página solicitada o por defecto
$route = $_GET['page'] ?? 'registro';

// 🛡️ Validación: si no hay sesión y la página no es pública → redirigir al login
if (!isset($_SESSION['usuario']) && !in_array($route, $paginas_sin_login)) {
    header("Location: index.php?page=login");
    exit;
}

// ✅ Enrutador principal
switch ($route) {
    case 'registro':
        require_once 'controllers/EstudianteController.php';
        $controller = new EstudianteController();
        $controller->mostrarFormulario();
        break;

    case 'guardar':
        require_once 'controllers/EstudianteController.php';
        $controller = new EstudianteController();
        $controller->guardar();
        break;

    case 'listado':
        require_once 'controllers/EstudianteController.php';
        $controller = new EstudianteController();
        $controller->mostrarListado();
        break;

    case 'login':
        require_once 'views/login.php';
        break;

    case 'procesar_login':
        require_once 'Confi/Database.php';
        $conn = (new Database())->getConnection();

        $usuario = $_POST['usuario'] ?? '';
        $clave = $_POST['clave'] ?? '';

        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['clave'] === $clave) { // ⚠️ Usa password_verify si usas hash
            $_SESSION['usuario'] = $user['usuario'];
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

    $controllerEst = new EstudianteController();
    $controllerCol = new ColegioController();

    $total = $controllerEst->contarEstudiantes();
    $totalColegios = $controllerCol->contarColegios(); // este es el nuevo

    require_once 'views/dashboard.php';
    break;


     
        
    case 'preregistro':
    require_once 'controllers/ColegioController.php';
    $controller = new ColegioController();
    $controller->mostrarFormulario();
    break;

    case 'guardar_colegio':
    require_once 'controllers/ColegioController.php';
    $controller = new ColegioController();
    $controller->guardar();
    break;


    default:
        echo "Página no encontrada";
        break;
    
}
