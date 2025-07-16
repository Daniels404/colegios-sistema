<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema Colegio</title>
    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link href="css/estilos.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- ✅ Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php?page=dashboard"><i class="bi bi-mortarboard-fill me-2"></i>Sistema Colegio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="index.php?page=dashboard"><i class="bi bi-house-door-fill me-1"></i>Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=registro"><i class="bi bi-person-plus-fill me-1"></i>Registrar Estudiante</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=listado"><i class="bi bi-card-list me-1"></i>Listado Estudiantes</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=registrar_colegio"><i class="bi bi-building-add me-1"></i>Registrar Colegio</a></li>
                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                <li class="nav-item"><a class="nav-link" href="index.php?page=usuarios"><i class="bi bi-people-fill me-1"></i>Usuarios</a></li>
                <?php endif; ?>
            </ul>
            <span class="navbar-text text-white me-3">
                Bienvenido, <b><?= $_SESSION['usuario'] ?? 'Invitado' ?></b>
                <?php if (!empty($_SESSION['rol'])): ?>
                    <span class="badge bg-warning text-dark ms-2">Rol: <?= htmlspecialchars($_SESSION['rol']) ?></span>
                <?php endif; ?>
            </span>
            <a href="index.php?page=logout" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
