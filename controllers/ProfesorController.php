<?php


require_once 'models/Profesor.php';
require_once 'models/Materia.php';

class ProfesorController {
    public function mostrarFormulario() {
        $materiaModel = new Materia();
        $materias = $materiaModel->obtenerTodas();
        require 'views/registro_profesor.php';
    }

    public function guardar() {
        $profesorModel = new Profesor();
        $materiaModel = new Materia();

        // Validar documento único
        $documento = $_POST['documento'];
        if ($profesorModel->existeDocumento($documento)) {
            $_SESSION['error'] = "El documento <strong>$documento</strong> ya está registrado.";
            header('Location: index.php?c=Profesor&a=listar');
            exit;
        }

        $data = [
            'nombre'             => $_POST['nombre'],
            'documento'          => $documento,
            'contacto'           => $_POST['contacto'],
            'correo'             => $_POST['correo'],
            'rh'                 => $_POST['rh'],
            'numero_estudiantes' => $_POST['numero_estudiantes'],
            'jornada'            => $_POST['jornada'],
            'materia_id'         => $_POST['materia_id']
        ];

        // Registrar profesor
        $profesorModel->registrar($data);

        // Obtener el último ID insertado del profesor
        $profesor_id = $profesorModel->obtenerUltimoId();

        // Asignar la materia al profesor (tabla materia_profesor)
        $materiaModel->asignarAMaestro($data['materia_id'], $profesor_id);

        // Mensaje de éxito
        $materia = $materiaModel->buscarPorId($data['materia_id']);
        $_SESSION['mensaje'] = "✅ Profesor <strong>{$data['nombre']}</strong> registrado correctamente y asignado a <strong>{$materia['nombre']}</strong>.";

        header('Location: index.php?c=Profesor&a=listar');
        exit;
    }

    public function listar() {
        $profesorModel = new Profesor();
        $profesores = $profesorModel->obtenerTodos();
        require 'views/listado_profesores.php';
    }

    public function editar() {
        $id = $_GET['id'];
        $profesorModel = new Profesor();
        $materiaModel = new Materia();

        $profesor = $profesorModel->buscarPorId($id);
        $materias = $materiaModel->obtenerTodas();

        require 'views/editar_profesor.php';
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
            'nombre'             => $_POST['nombre'] ?? '',
            'contacto'           => $_POST['contacto'] ?? '',
            'correo'             => $_POST['correo'] ?? '',
            'rh'                 => $_POST['rh'] ?? '',
            'numero_estudiantes' => $_POST['numero_estudiantes'] ?? '',
            'jornada'            => $_POST['jornada'] ?? '',
            'materia_id'         => $_POST['materia_id'] ?? ''
        ];

        $profesorModel = new Profesor();
        $profesorModel->actualizar($id, $data);

        $_SESSION['mensaje'] = "✅ Profesor actualizado correctamente.";
        header("Location: index.php?c=Profesor&a=listar");
        exit;
    }
}
}