<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Bienvenida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- ✅ Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php?page=dashboard">Sistema Colegio</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php?page=dashboard">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=registro">Registrar</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=listado">Listado</a></li>
            </ul>
            <span class="navbar-text text-white me-3">Bienvenido, <?= $_SESSION['usuario'] ?? '' ?></span>
            <a href="index.php?page=logout" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
        </div>
    </div>
</nav>

<!-- ✅ Contenido principal -->
<div class="container mt-4">
    <h2 class="mb-4">👋 Bienvenido al Sistema Institucional</h2>

    <div class="row g-4">
        <!-- Tarjeta 1 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-start border-primary border-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-people-fill me-2"></i>Total Estudiantes</h5>
                  <p class="card-text display-6 fw-bold text-primary"><?= $total ?></p>
                    <p class="card-text">Número total de estudiantes registrados en el sistema.</p>
                    <a href="index.php?page=listado" class="btn btn-primary mt-2">Ver listado</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta 2 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-start border-success border-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-person-plus-fill me-2"></i>Registrar Estudiante</h5>
                    <a href="index.php?page=registro" class="btn btn-success mt-2">Ir al formulario</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta 3 -->
        <div class="col-md-4">
            <div class="card shadow-sm border-start border-info border-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-card-list me-2"></i>Ver Listado</h5>
                    <a href="index.php?page=listado" class="btn btn-info mt-2 text-white">Ver estudiantes</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ✅ Footer -->
<footer class="bg-dark text-white text-center mt-5 py-3">
    <small>Sistema Colegio - Desarrollado por Daniel Zapata © <?= date('Y') ?></small>
</footer>

</body>
</html>
