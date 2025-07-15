
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($totalColegios)) $totalColegios = 0;
if (!isset($total)) $total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Bienvenida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #232526 0%, #414345 100%);
            min-height: 100vh;
        }
        .dashboard-card {
            border-radius: 1.2rem;
            box-shadow: 0 4px 24px rgba(0,0,0,0.12);
            transition: transform 0.15s;
        }
        .dashboard-card:hover {
            transform: translateY(-6px) scale(1.03);
        }
        .dashboard-title {
            color: #fff;
            text-shadow: 0 2px 8px #0002;
        }
        .dashboard-section {
            margin-top: 2.5rem;
        }
        .dashboard-btn {
            background: linear-gradient(90deg, #ff512f 0%, #dd2476 100%);
            color: #fff;
            border: none;
        }
        .dashboard-btn:hover {
            background: linear-gradient(90deg, #dd2476 0%, #ff512f 100%);
            color: #fff;
        }
        .dashboard-card-admin {
            background: linear-gradient(90deg, #ff512f 0%, #dd2476 100%);
            color: #fff;
        }
        .dashboard-card-admin .btn {
            background: #fff;
            color: #dd2476;
            font-weight: bold;
        }
        .dashboard-card-admin .btn:hover {
            background: #ffe0ef;
            color: #ff512f;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php?page=dashboard"><i class="bi bi-mortarboard-fill me-2"></i>Sistema Colegio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="index.php?page=dashboard"><i class="bi bi-house-door-fill me-1"></i>Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=registro"><i class="bi bi-person-plus-fill me-1"></i>Registrar Estudiante</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=listado"><i class="bi bi-card-list me-1"></i>Listado Estudiantes</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=registrar_colegio"><i class="bi bi-building-add me-1"></i>Registrar Colegio</a></li>
                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                <li class="nav-item"><a class="nav-link" href="index.php?page=usuarios"><i class="bi bi-people-fill me-1"></i>Usuarios</a></li>
                <?php endif; ?>
            </ul>
            <span class="navbar-text text-white me-3">Bienvenido, <b><?= $_SESSION['usuario'] ?? '' ?></b></span>
            <a href="index.php?page=logout" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
        </div>
    </div>
</nav>

<div class="dashboard-section">
    <h2 class="dashboard-title mb-4 text-center"><i class="bi bi-emoji-smile"></i> Bienvenido al Sistema Institucional Tecno Academia</h2>

    <div class="row g-4 justify-content-center">
        <!-- Tarjeta: Total Estudiantes (solo número) -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 d-flex align-items-stretch">
            <div class="card dashboard-card border-primary border-3 w-100">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary mb-3" style="font-size:1.25rem;"><i class="bi bi-people-fill me-2"></i>Total Estudiantes</h5>
                    <p class="card-text fw-bold text-primary mb-0" style="font-size:2.8rem; line-height:1;"><?= $total ?></p>
                </div>
            </div>
        </div>
        <!-- Tarjeta: Total Colegios (con botón) -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 d-flex align-items-stretch">
            <div class="card dashboard-card border-warning border-3 w-100">
                <div class="card-body text-center">
                    <h5 class="card-title text-warning mb-3" style="font-size:1.25rem;"><i class="bi bi-building me-2"></i>Total Colegios</h5>
                    <p class="card-text fw-bold text-warning mb-2" style="font-size:2.8rem; line-height:1;"><?= $totalColegios ?></p>
                    <a href="index.php?page=registrar_colegio" class="btn btn-sm dashboard-btn mt-3"><i class="bi bi-building-add me-1"></i>Registrar Colegio</a>
                </div>
            </div>
        </div>

    </div>

   
   
                </div>
            </div>
        </div>

        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
        <!-- Tarjeta: Gestión de Usuarios (centrada, solo admin) -->
        <div class="row justify-content-center mt-4">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4 d-flex align-items-stretch">
                <div class="card dashboard-card dashboard-card-admin border-0 w-100">
                    <div class="card-body text-center py-3">
                        <h5 class="fw-bold mb-2" style="font-size:1.15rem;"><i class="bi bi-person-lines-fill me-2"></i>Gestión de Usuarios</h5>
                        <a href="index.php?page=usuarios" class="btn btn-sm dashboard-btn mt-2"><i class="bi bi-people me-1"></i>Ver usuarios</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>


