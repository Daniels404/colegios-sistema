<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'models/Colegio.php';
$colegioModel = new Colegio();
$colegios = $colegioModel->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Estudiante</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link href="css/estilos.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<!-- ✅ Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php?page=dashboard"><i class="bi bi-mortarboard-fill"></i> Sistema Colegio</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php?page=registro">Registrar</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=listado">Listado</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=preregistro"><i class="bi bi-building-add"></i> Registrar Colegio</a></li>
            </ul>
            <span class="navbar-text text-white me-3">Bienvenido, <?= $_SESSION['usuario'] ?? '' ?></span>
            <a href="index.php?page=logout" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
        </div>
    </div>
</nav>

<!-- ✅ Formulario de Registro -->
<div class="container">
    <h2 class="mb-4"><i class="bi bi-person-plus-fill me-1"></i> Registro de Estudiante</h2>

    <form method="POST" action="index.php?page=guardar" class="bg-white p-4 rounded shadow">

        <!-- Colegio -->
        <div class="mb-3">
            <label class="form-label">Colegio</label>
            <select name="colegio_id" class="form-select" required>
                <option value="">Seleccione una institución...</option>
                <?php foreach ($colegios as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Nombre del estudiante -->
        <div class="mb-3">
            <label class="form-label">Nombre del Estudiante</label>
            <input type="text" name="nombre_alumno" class="form-control" required>
        </div>

        <!-- Tipo de documento y documento -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Tipo de Documento</label>
                <select name="tipo_documento" class="form-select" required>
                    <option value="">Seleccione...</option>
                    <option value="TI">Tarjeta de Identidad</option>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="CE">Cédula de Extranjería</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Número de Documento</label>
                <input type="text" name="documento_estudiante" class="form-control" required>
            </div>
        </div>

        <!-- RH y Jornada -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">RH</label>
                <input type="text" name="rh" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Jornada</label>
                <select name="jornada" class="form-select" required>
                    <option value="">Seleccione...</option>
                    <option value="Mañana">Mañana</option>
                    <option value="Tarde">Tarde</option>
                </select>
            </div>
        </div>

        <!-- Asignatura -->
        <div class="mb-3">
            <label class="form-label">Asignatura</label>
            <input type="text" name="asignatura" class="form-control">
        </div>

        <!-- Contacto y correo del estudiante -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Correo</label>
                <input type="email" name="correo" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Número de Contacto</label>
                <input type="text" name="numero_contacto" class="form-control">
            </div>
        </div>

        <!-- Nombre y contacto del acudiente -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nombre del Acudiente</label>
                <input type="text" name="nombre" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Contacto del Acudiente</label>
                <input type="text" name="contacto" class="form-control">
            </div>
        </div>

        <!-- Observaciones -->
        <div class="mb-3">
            <label class="form-label">Observaciones</label>
            <textarea name="observaciones" class="form-control" rows="3"></textarea>
        </div>

        <!-- Botón -->
        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle-fill me-1"></i> Registrar Estudiante
        </button>
    </form>
</div>

<!-- ✅ Footer -->
<footer class="text-center mt-5 py-3 bg-dark text-white">
    <small>Sistema Colegio - Desarrollado por Daniel Zapata © <?= date('Y') ?></small>
</footer>

</body>
</html>
