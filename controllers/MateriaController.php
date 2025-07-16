<?php
require_once 'models/Materia.php';
require_once 'models/Profesor.php';

class MateriaController {
    public function mostrarFormulario() {
        $profesorModel = new Profesor();
        $profesores = $profesorModel->obtenerTodos();
        require 'views/registro_materia.php';
    }

    public function guardar() {
        $model = new Materia();
        $data = [
            'nombre' => $_POST['nombre'],
            'profesor_id' => $_POST['profesor_id']
        ];
        $model->registrar($data);
        $_SESSION['mensaje'] = "Materia registrada correctamente.";
        header("Location: index.php?page=materias");
    }

    public function listar() {
        $model = new Materia();
        $materias = $model->obtenerTodasConProfesor();
        require 'views/listado_materias.php';
    }
}
