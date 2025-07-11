<?php
require_once 'models/Estudiante.php';
require_once 'models/Colegio.php';

class EstudianteController {
    public function mostrarFormulario() {
        $colegioModel = new Colegio();
        $colegios = $colegioModel->obtenerTodos();
      require 'views/registro.php';

    }

    public function guardar() {
        $estudiante = new Estudiante();
        $data = [
            'nombre' => $_POST['nombre'],
            'ficha' => $_POST['ficha'],
            'nombre_alumno' => $_POST['nombre_alumno'],
            'documento_estudiante' => $_POST['documento_estudiante'],
            'grado' => $_POST['grado'],
            'tipo_documento' => $_POST['tipo_documento'],
            'direccion' => $_POST['direccion'],
            'numero_contacto' => $_POST['numero_contacto'],
            'correo' => $_POST['correo'],
            'correo_inst' => $_POST['correo_inst'],
            'jornada' => $_POST['jornada'],
            'dias' => $_POST['dias'],
            'colegio' => $_POST['colegio'],
            'rector' => $_POST['rector'],
            'observaciones' => $_POST['observaciones'],
            'colegio_id' => $_POST['colegio_id'],
        ];

        $estudiante->registrar($data);
        header("Location: index.php?page=listado");
        exit;
    }
public function mostrarListado() {
    $modelo = new Estudiante();
   $estudiantes = $modelo->obtenerTodosConColegios(); // ✅ Sí existe y es correcto
// 👈 trae los datos
    require 'views/listado.php';
}

    public function contarEstudiantes() {
    $estudiante = new Estudiante();
    return $estudiante->contarEstudiantes();
}

public function contarColegios() {
    $modelo = new Colegio();
    return $modelo->contarTodos(); // O como hayas llamado al método en el modelo
}


}
