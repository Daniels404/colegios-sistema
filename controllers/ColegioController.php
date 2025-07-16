
<?php
require_once 'models/Colegio.php';

class ColegioController {
    // Mostrar solo el formulario de registro de colegio
    public function mostrarFormularioRegistro() {
        require 'views/registrar_colegio.php';
    }
    // Método para obtener todos los colegios (para dashboard)
    public function obtenerTodos() {
        $modelo = new Colegio();
        return $modelo->obtenerTodos();
    }

    public function mostrarFormulario() {
        $modelo = new Colegio();
        $colegios = $modelo->obtenerTodos(); // ✅ obtiene los colegios registrados
       require 'views/registrar_colegio.php'; // Esta vista debe contener SOLO el formulario
    }

    public function guardar() {
        $colegio = new Colegio();
        // Validación básica de campos vacíos
        $errores = [];
        foreach ([
            'nombre' => 'Nombre del colegio',
            'tipo' => 'Tipo',
            'direccion' => 'Dirección',
            'contacto' => 'Contacto',
            'rector' => 'Rector'
        ] as $campo => $nombreCampo) {
            if (empty($_POST[$campo])) {
                $errores[] = "El campo <b>$nombreCampo</b> es obligatorio.";
            }
        }

        if (!empty($errores)) {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">' . implode('<br>', $errores) . '</div>';
            header("Location: index.php?page=registrar_colegio");
            exit;
        }

        // Validar que el tipo sea exactamente 'Pública' o 'Privada'
        $tipo = trim($_POST['tipo']);
        if ($tipo !== 'Pública' && $tipo !== 'Privada') {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">El tipo de colegio debe ser "Pública" o "Privada".</div>';
            header("Location: index.php?page=registrar_colegio");
            exit;
        }

        $data = [
            'nombre' => trim($_POST['nombre']),
            'tipo' => $tipo,
            'direccion' => trim($_POST['direccion']),
            'contacto' => trim($_POST['contacto']),
            'rector' => trim($_POST['rector'])
        ];

        $exito = $colegio->registrar($data);

        if ($exito) {
            $_SESSION['mensaje'] = '<div class="alert alert-success">Colegio registrado exitosamente.</div>';
        } else {
            $_SESSION['mensaje'] = '<div class="alert alert-danger">Error al registrar el colegio. Intenta nuevamente.</div>';
        }
        header("Location: index.php?page=preregistro");
        exit;
    }

    public function contarColegios() {
        $colegioModel = new Colegio();
        return $colegioModel->contarTodos(); // ✅ debe retornar un número
    }

    public function guardarUsuarioPublico() {
        if (!class_exists('Usuario')) require_once 'models/Usuario.php';
        $usuarioModel = new Usuario();

        $data = [
            'usuario' => $_POST['usuario'],
            'clave'   => password_hash($_POST['clave'], PASSWORD_DEFAULT),
            'estado'  => 'pendiente',
            'rol_id'  => $_POST['rol_id'] ?? 2 // 👈 por defecto "usuario"
        ];

        $usuarioModel->registrar($data);

        $_SESSION['mensaje'] = 'Registro enviado. Espera aprobación del administrador.';
        header('Location: index.php?page=login'); // O donde esté tu login
        exit;
    }
}
