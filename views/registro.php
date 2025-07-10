<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= isset($estudiante) ? 'Editar Estudiante' : 'Registrar Estudiante' ?></title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Animate.css -->
    <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <link href="css/estilos.css" rel="stylesheet">

    <!-- Tipografía clara (Google Fonts - Open Sans) -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f4f7fc;
        }

        .navbar {
            background-color: #003366;
        }

        .navbar-brand, .nav-link, .navbar-text {
            color: #ffffff !important;
        }

        .navbar-brand i {
            margin-right: 5px;
        }

        h2 {
            color: #003366;
            font-weight: 700;
        }

        .form-control, .form-select {
            border-radius: 0.375rem;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .footer {
            margin-top: 60px;
            padding: 20px;
            background-color: #003366;
            color: white;
            text-align: center;
            font-size: 0.9rem;
        }
    </style>
</head>
<body class="p-4">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php?page=registro">
            <i class="bi bi-mortarboard-fill"></i> Sistema Colegio
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?page=registro"><i class="bi bi-person-plus-fill me-1"></i>Registrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=listado"><i class="bi bi-card-list me-1"></i>Listado</a>
                </li>
            </ul>
            <span class="navbar-text text-white me-3">
                <i class="bi bi-person-circle me-1"></i><?= $_SESSION['usuario'] ?? '' ?>
            </span>
            <a href="index.php?page=logout" class="btn btn-outline-light btn-sm">
                <i class="bi bi-box-arrow-right"></i> Cerrar sesión
            </a>
        </div>
    </div>
</nav>

<!-- Formulario -->
<div class="container">
    <h2 class="mb-4"><?= isset($estudiante) ? 'Editar Estudiante' : 'Registrar Estudiante' ?></h2>

    <form method="POST" action="index.php?page=guardar" class="shadow p-4 bg-white rounded animate__animated animate__fadeIn">
        <input type="hidden" name="id" value="<?= $estudiante['id'] ?? '' ?>">

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Nombre del Acudiente</label>
                <input type="text" name="nombre" class="form-control" required value="<?= $estudiante['nombre'] ?? '' ?>">
            </div>
            <div class="col-md-6">
                <label>Ficha</label>
                <input type="text" name="ficha" class="form-control" value="<?= $estudiante['ficha'] ?? '' ?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Nombre del Alumno</label>
                <input type="text" name="nombre_alumno" class="form-control" required value="<?= $estudiante['nombre_alumno'] ?? '' ?>">
            </div>
            <div class="col-md-6">
                <label>Documento del Estudiante</label>
                <input type="text" name="documento_estudiante" class="form-control" required value="<?= $estudiante['documento_estudiante'] ?? '' ?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label>Grado</label>
                <input type="text" name="grado" class="form-control" value="<?= $estudiante['grado'] ?? '' ?>">
            </div>
            <div class="col-md-4">
                <label>Tipo de Documento</label>
                <input type="text" name="tipo_documento" class="form-control" value="<?= $estudiante['tipo_documento'] ?? '' ?>">
            </div>
            <div class="col-md-4">
                <label>Dirección</label>
                <input type="text" name="direccion" class="form-control" value="<?= $estudiante['direccion'] ?? '' ?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label>Número de Contacto</label>
                <input type="text" name="numero_contacto" class="form-control" value="<?= $estudiante['numero_contacto'] ?? '' ?>">
            </div>
            <div class="col-md-4">
                <label>Correo</label>
                <input type="email" name="correo" class="form-control" value="<?= $estudiante['correo'] ?? '' ?>">
            </div>
            <div class="col-md-4">
                <label>Correo Institucional</label>
                <input type="email" name="correo_inst" class="form-control" value="<?= $estudiante['correo_inst'] ?? '' ?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Jornada</label>
                <select name="jornada" class="form-select" required>
                    <option value="">Seleccione...</option>
                    <option value="Mañana" <?= isset($estudiante['jornada']) && $estudiante['jornada'] == 'Mañana' ? 'selected' : '' ?>>Mañana</option>
                    <option value="Tarde" <?= isset($estudiante['jornada']) && $estudiante['jornada'] == 'Tarde' ? 'selected' : '' ?>>Tarde</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Días de Asistencia</label>
                <select name="dias" class="form-select" required>
                    <option value="">Seleccione...</option>
                    <option value="Lunes y Miércoles" <?= isset($estudiante['dias']) && $estudiante['dias'] == 'Lunes y Miércoles' ? 'selected' : '' ?>>Lunes y Miércoles</option>
                    <option value="Martes y Jueves" <?= isset($estudiante['dias']) && $estudiante['dias'] == 'Martes y Jueves' ? 'selected' : '' ?>>Martes y Jueves</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Colegio</label>
                <input type="text" name="colegio" class="form-control" required value="<?= $estudiante['colegio'] ?? '' ?>">
            </div>
            <div class="col-md-6">
                <label>Rector</label>
                <input type="text" name="rector" class="form-control" value="<?= $estudiante['rector'] ?? '' ?>">
            </div>
        </div>

        <div class="mb-3">
            <label>Observaciones</label>
            <textarea name="observaciones" class="form-control" rows="3"><?= $estudiante['observaciones'] ?? '' ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle-fill me-1"></i>
            <?= isset($estudiante) ? 'Actualizar Estudiante' : 'Registrar Estudiante' ?>
        </button>

        <?php if (isset($estudiante)): ?>
            <a href="index.php?page=listado" class="btn btn-secondary ms-2">
                <i class="bi bi-x-circle me-1"></i> Cancelar
            </a>
        <?php endif; ?>
    </form>
</div>

<!-- Footer institucional -->
<footer class="footer">
    © <?= date('Y') ?> Sistema de Gestión Colegio - Desarrollado por Daniel Stiven Zapata
</footer>

</body>
</html>
