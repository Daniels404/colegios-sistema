<?php
require_once 'models/Materia.php';
require_once 'models/Profesor.php';

class MateriaController {

    // Mostrar formulario de asignación de materia a profesor
    public function mostrarFormulario() {
        $profesorModel = new Profesor();
        $materiaModel = new Materia();

        $profesores = $profesorModel->obtenerTodos();
        $materias = $materiaModel->obtenerTodas();

        require 'views/registro_materia.php';
    }

    // Guardar asignación
public function guardar() {
    require_once 'models/Materia.php';
    $materiaModel = new Materia();

    $materia_id = $_POST['materia_id'] ?? null;
    $profesor_id = $_POST['profesor_id'] ?? null;

    if ($materia_id && $profesor_id) {
        $materiaModel->asignarAMaestro($materia_id, $profesor_id);
        $_SESSION['mensaje'] = 'Materia asignada correctamente.';
        header("Location: index.php?page=materias"); // Redirige al listado
    } else {
        $_SESSION['mensaje'] = 'Faltan datos para asignar la materia.';
        header("Location: index.php?page=registro_materia");
    }
    exit;
}


    // Listar todas las asignaciones materia-profesor
public function listar() {
    require_once 'models/Materia.php';
    $materiaModel = new Materia();

    // ✅ Debes llamar a obtenerTodasConProfesor()
    $materias = $materiaModel->obtenerTodasConProfesor();

    require 'views/listado_materias.php';
}

}
