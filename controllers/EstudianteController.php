<?php
require_once 'models/Estudiante.php';
require_once 'models/Colegio.php';
require_once 'models/RH.php';
require_once 'models/TipoDocumento.php';
require_once 'models/Grado.php';




class EstudianteController {
public function mostrarFormulario() {
    $colegioModel = new Colegio();
    $colegios = $colegioModel->obtenerTodos();

    $rhModel = new RH(); // ✅ Instancia del modelo RH
    $tiposRh = $rhModel->obtenerTodos();

    $tipoDocModel = new TipoDocumento(); // ✅ Instancia del modelo TipoDocumento
    $tiposDocumento = $tipoDocModel->obtenerTodos();

    $gradoModel = new Grado();
    $grados = $gradoModel->obtenerTodos();

    require 'views/registro.php';
}

public function guardar() {
    $estudiante = new Estudiante();

    // 🔐 Validar que el grado sea uno de los permitidos
    $grado = trim($_POST['grado'] ?? '');
    $gradosPermitidos = ['7', '8', '9', '10', '11'];

    if (!in_array($grado, $gradosPermitidos)) {
        $_SESSION['error'] = 'Grado inválido. Solo se permite del 7 al 11.';
        header("Location: index.php?page=registro");
        exit;
    }

    // 🧩 Armar el arreglo con los datos del formulario
    $data = [
        'nombre' => $_POST['nombre'] ?? '',
        'ficha' => $_POST['ficha'] ?? '',
        'nombre_alumno' => $_POST['nombre_alumno'] ?? '',
        'documento_estudiante' => $_POST['documento_estudiante'] ?? '',
        'grado' => $grado, // ⬅️ Ya viene validado
        'tipo_documento' => $_POST['tipo_documento'] ?? '',
        'direccion' => $_POST['direccion'] ?? '',
        'numero_contacto' => $_POST['numero_contacto'] ?? '',
        'correo' => $_POST['correo'] ?? '',
        'correo_inst' => $_POST['correo_inst'] ?? '',
        'jornada' => $_POST['jornada'] ?? '',
        'dias' => $_POST['dias'] ?? '',
        'colegio' => $_POST['colegio'] ?? '',
        'rector' => $_POST['rector'] ?? '',
        'observaciones' => $_POST['observaciones'] ?? '',
        'colegio_id' => $_POST['colegio_id'] ?? null,
    ];

    // ✅ Insertar en la BD
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
