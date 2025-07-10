<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // 🟢 Iniciar sesión si no está activa
}

$route = $_GET['page'] ?? 'registro';

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

    if ($user && $user['clave'] === $clave) { // luego puedes usar password_verify aquí
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
    $controller = new EstudianteController();
    $total = $controller->contarEstudiantes();
    require_once 'views/dashboard.php';
    break;



    

    default:
        echo "Página no encontrada";
        break;



}
