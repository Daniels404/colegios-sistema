<?php
require_once 'models/Estudiante.php';
require_once 'models/Colegio.php';
require_once 'models/Grado.php';

class EstudianteController {
    private $model;

    public function __construct() {
        $this->model = new Estudiante();
    }

    public function index() {
        $estudiantes = $this->model->obtenerTodos();
        $mensaje = $_GET['mensaje'] ?? null;

        require 'views/layout/header.php';
        require 'views/estudiantes/listado_estudiantes.php';
        require 'views/layout/footer.php';
    }

    public function registrar() {
        $colegios = (new Colegio())->obtenerTodos();
        $grados = (new Grado())->obtenerTodos();

        require 'views/layout/header.php';
        require 'views/estudiantes/registro.php';
        require 'views/layout/footer.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'ficha' => $_POST['ficha'] ?? '',
                'nombre_alumno' => $_POST['nombre_alumno'] ?? '',
                'documento_estudiante' => $_POST['documento_estudiante'] ?? '',
                'tipo_documento' => $_POST['tipo_documento'] ?? '',
                'grado' => $_POST['grado'] ?? '',
                'colegio_id' => $_POST['colegio_id'] ?? '',
                'direccion' => $_POST['direccion'] ?? '',
                'correo_inst' => $_POST['correo_inst'] ?? '',
                'rh' => $_POST['rh'] ?? '',
                'jornada' => $_POST['jornada'] ?? '',
                'rector' => $_POST['rector'] ?? '',
                'colegio' => $_POST['colegio'] ?? '',
                'correo' => $_POST['correo'] ?? '',
                'numero_contacto' => $_POST['numero_contacto'] ?? '',
                'contacto' => $_POST['contacto'] ?? '',
                'observaciones' => $_POST['observaciones'] ?? ''
            ];

            $this->model->registrar($data);

            header('Location: index.php?c=Estudiante&mensaje=Registro+exitoso');
            exit;
        }
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID no proporcionado.";
            return;
        }

        $estudiante = $this->model->obtenerPorId($id);
        $colegios = (new Colegio())->obtenerTodos();
        $grados = (new Grado())->obtenerTodos();

        require 'views/layout/header.php';
        require 'views/estudiantes/editar_estudiante.php';
        require 'views/layout/footer.php';
    }

    public function actualizar() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            session_start();

            $id = $_POST['id'] ?? null;
            if (!$id) {
                echo "ID no proporcionado.";
                return;
            }

            $data = [
                'numero_contacto' => $_POST['numero_contacto'] ?? '',
                'correo' => $_POST['correo'] ?? '',
                'direccion' => $_POST['direccion'] ?? '',
                'jornada' => $_POST['jornada'] ?? '',
                'observaciones' => $_POST['observaciones'] ?? ''
            ];

            $this->model->actualizarDatosContacto($id, $data);

            $_SESSION['mensaje'] = "✅ Estudiante actualizado correctamente.";
            header("Location: index.php?c=Estudiante");
            exit;
        }
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->eliminar($id);
        }
        header('Location: index.php?c=Estudiante');
    }

    public function contarEstudiantes() {
        return $this->model->contarEstudiantes();
    }

    public function crear() {
        $colegios = (new Colegio())->obtenerTodos();
        $grados = (new Grado())->obtenerTodos();
    
        // Este archivo debe existir en views/estudiantes/
        require 'views/layout/header.php';
        require 'views/estudiantes/registro.php';
        require 'views/layout/footer.php';
    }
    
}
    