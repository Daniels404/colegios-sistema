<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Estudiantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<!-- ✅ Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php?page=registro">Sistema Colegio</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php?page=registro">Registrar</a></li>
                <li class="nav-item"><a class="nav-link active" href="index.php?page=listado">Listado</a></li>
            </ul>
            <span class="navbar-text text-white me-3">Bienvenido, <?= $_SESSION['usuario'] ?? '' ?></span>
            <a href="index.php?page=logout" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
        </div>
    </div>
</nav>

<!-- ✅ Contenido principal -->
<div class="container">
    <h2 class="mb-4">Listado de Estudiantes Registrados</h2>
    <a href="index.php?page=registro" class="btn btn-primary mb-3">+ Nuevo Estudiante</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Alumno</th>
                    <th>Grado</th>
                    <th>Jornada</th>
                    <th>Días</th>
                    <th>Colegio</th>
                    <th>Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($estudiantes)): ?>
                    <?php foreach ($estudiantes as $e): ?>
                        <tr>
                            <td><?= $e['id'] ?></td>
                            <td><?= htmlspecialchars($e['nombre']) ?></td>
                            <td><?= htmlspecialchars($e['nombre_alumno']) ?></td>
                            <td><?= $e['grado'] ?></td>
                            <td><?= $e['jornada'] ?></td>
                            <td><?= $e['dias'] ?></td>
                            <td><?= htmlspecialchars($e['colegio']) ?></td>
                            <td><?= $e['fecha_registro'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8" class="text-center">No hay estudiantes registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
