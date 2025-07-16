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

        $data = [
            'nombre'             => $_POST['nombre'],
            'documento'          => $_POST['documento'],
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

      $nombre = $_POST['nombre'];
$materia_id = $_POST['materia_id'];

$materiaModel = new Materia();
$materia = $materiaModel->buscarPorId($materia_id);

$_SESSION['mensaje'] = "✅ Profesor <strong>{$nombre}</strong> registrado correctamente y asignado a <strong>{$materia['nombre']}</strong>.";

    }

    public function listar() {
        $profesorModel = new Profesor();
        $profesores = $profesorModel->obtenerTodos();
        require 'views/listado_profesores.php';
    }
}
