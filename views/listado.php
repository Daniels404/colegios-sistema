<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Estudiantes</title>
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
                <li class="nav-item"><a class="nav-link" href="index.php?page=dashboard">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=registro">Registrar</a></li>
                <li class="nav-item"><a class="nav-link active" href="index.php?page=listado">Listado</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=preregistro">Registrar Colegio</a></li>
            </ul>
            <span class="navbar-text text-white me-3">
                Bienvenido, <?= $_SESSION['usuario'] ?? '' ?>
            </span>
            <a href="index.php?page=logout" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
        </div>
    </div>
</nav>


<footer class="bg-dark text-white text-center mt-5 py-3">
    <small>Sistema Colegio - Desarrollado por Daniel Zapata © <?= date('Y') ?></small>
</footer>
