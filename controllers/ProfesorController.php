<?php
require_once 'models/Profesor.php';

class ProfesorController {
    public function mostrarFormulario() {
        require 'views/registro_profesor.php';
    }

    public function guardar() {
        $model = new Profesor();
        $data = [
            'nombre' => $_POST['nombre'],
            'documento' => $_POST['documento'],
            'contacto' => $_POST['contacto'],
            'correo' => $_POST['correo'],
            'rh' => $_POST['rh'],
            'numero_estudiantes' => $_POST['numero_estudiantes'],
            'jornada' => $_POST['jornada']
        ];
        $model->registrar($data);
        $_SESSION['mensaje'] = "Profesor registrado correctamente.";
        header("Location: index.php?page=profesores");
    }

    public function listar() {
        $model = new Profesor();
        $profesores = $model->obtenerTodos();
        require 'views/listado_profesores.php';
    }
}
