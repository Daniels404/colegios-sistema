<?php
require_once 'models/Estudiante.php';

class EstudianteController {
    public function mostrarFormulario() {
        if (isset($_GET['id'])) {
            $estudiante = Estudiante::buscarPorId($_GET['id']);
            if (!$estudiante) {
                echo "<script>alert('Estudiante no encontrado'); window.location='index.php?page=listado';</script>";
                exit;
            }
        }
        require_once 'views/registro.php';
    }

    public function guardar() {
        $data = [
            'nombre' => $_POST['nombre'] ?? '',
            'ficha' => $_POST['ficha'] ?? '',
            'rector' => $_POST['rector'] ?? '',
            'nombre_alumno' => $_POST['nombre_alumno'] ?? '',
            'documento_estudiante' => $_POST['documento_estudiante'] ?? '',
            'grado' => $_POST['grado'] ?? '',
            'tipo_documento' => $_POST['tipo_documento'] ?? '',
            'direccion' => $_POST['direccion'] ?? '',
            'numero_contacto' => $_POST['numero_contacto'] ?? '',
            'correo' => $_POST['correo'] ?? '',
            'correo_inst' => $_POST['correo_inst'] ?? '',
            'jornada' => $_POST['jornada'] ?? '',
            'dias' => $_POST['dias'] ?? '',
            'colegio' => $_POST['colegio'] ?? '',
            'observaciones' => $_POST['observaciones'] ?? ''
        ];

        $estudiante = new Estudiante();

        if (!empty($_POST['id'])) {
            $resultado = Estudiante::actualizar($_POST['id'], $data);
            $mensaje = $resultado ? 'Estudiante actualizado correctamente' : 'Error al actualizar';
        } else {
            $resultado = $estudiante->registrar($data);
            $mensaje = $resultado ? 'Estudiante registrado correctamente' : 'Error al registrar';
        }

        echo "<script>alert('$mensaje'); window.location='index.php?page=listado';</script>";
        exit;
    }

    public function mostrarListado() {
        $estudiante = new Estudiante();
        $estudiantes = $estudiante->obtenerTodos();
        require_once 'views/listado.php';
    }

    public function editar($id) {
        $estudiante = Estudiante::buscarPorId($id);
        if ($estudiante) {
            require 'views/registro.php';
        } else {
            echo "<script>alert('Estudiante no encontrado'); window.location='index.php?page=listado';</script>";
            exit;
        }
    }

    public function eliminar($id) {
        $resultado = Estudiante::eliminar($id);
        $mensaje = $resultado ? 'Estudiante eliminado correctamente' : 'Error al eliminar';
        echo "<script>alert('$mensaje'); window.location='index.php?page=listado';</script>";
        exit;
    }

    public function contarEstudiantes() {
        $conn = (new Database())->getConnection();
        $stmt = $conn->query("SELECT COUNT(*) AS total FROM estudiantes");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }
}
