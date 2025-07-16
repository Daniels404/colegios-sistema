<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($totalColegios)) $totalColegios = 0;
if (!isset($total)) $total = 0;
if (!isset($totalMaterias)) $totalMaterias = 0;
if (!isset($totalProfesores)) $totalProfesores = 0;
if (!isset($materiasPorProfesor)) $materiasPorProfesor = [];
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
        .dashboard-section {
            margin-top: 2.5rem;
            padding-bottom: 4rem;
        }
        .dashboard-title {
            color: #fff;
            text-shadow: 0 2px 8px #0002;
        }
        .dashboard-card {
            border-radius: 1.2rem;
            box-shadow: 0 4px 24px rgba(0,0,0,0.15);
            transition: transform 0.2s ease-in-out;
            min-height: 220px;
        }
        .dashboard-card:hover {
            transform: translateY(-6px) scale(1.02);
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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php?page=dashboard">
            <i class="bi bi-mortarboard-fill me-2"></i>Sistema Colegio
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
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

<!-- Dashboard Content -->
<div class="dashboard-section container">
    <h2 class="dashboard-title mb-5 text-center">
        <i class="bi bi-emoji-smile"></i> Bienvenido al Sistema Institucional Tecno Academia
    </h2>

    <!-- Cards Centradas -->
    <div class="row justify-content-center g-4 text-center">
        <div class="col-md-6 col-lg-3 d-flex">
            <div class="card dashboard-card border-primary border-3 w-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title text-primary mb-3"><i class="bi bi-people-fill me-2"></i>Total Estudiantes</h5>
                    <p class="card-text fw-bold text-primary fs-2"><?= $total ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex">
            <div class="card dashboard-card border-warning border-3 w-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title text-warning mb-3"><i class="bi bi-building me-2"></i>Total Colegios</h5>
                    <p class="card-text fw-bold text-warning fs-2"><?= $totalColegios ?></p>
                    <a href="index.php?page=registrar_colegio" class="btn btn-sm dashboard-btn mt-3">
                        <i class="bi bi-building-add me-1"></i>Registrar Colegio
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex">
            <div class="card dashboard-card border-success border-3 w-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title text-success mb-3"><i class="bi bi-journal-text me-2"></i>Materias Registradas</h5>
                    <p class="card-text fw-bold text-success fs-2"><?= $totalMaterias ?></p>
                    <a href="index.php?page=materias" class="btn btn-sm dashboard-btn mt-3">
                        <i class="bi bi-eye me-1"></i>Ver Materias
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex">
            <div class="card dashboard-card border-info border-3 w-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title text-info mb-3"><i class="bi bi-person-bounding-box me-2"></i>Profesores Registrados</h5>
                    <p class="card-text fw-bold text-info fs-2"><?= $totalProfesores ?></p>
                    <a href="index.php?page=profesores" class="btn btn-sm dashboard-btn mt-3">
                        <i class="bi bi-arrow-right-circle me-1"></i>Ver Detalles
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico desplegable -->
    <div class="container mt-5">
        <div class="accordion" id="accordionGrafico">
            <div class="accordion-item shadow">
                <h2 class="accordion-header" id="headingGrafico">
                    <button class="accordion-button collapsed bg-success text-white fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGrafico" aria-expanded="false" aria-controls="collapseGrafico">
                        <i class="bi bi-bar-chart-fill me-2"></i> Ver gráfico de materias por profesor
                    </button>
                </h2>
                <div id="collapseGrafico" class="accordion-collapse collapse" aria-labelledby="headingGrafico" data-bs-parent="#accordionGrafico">
                    <div class="accordion-body">
                        <div class="card shadow-sm">
                            <div class="card-body" style="height: 400px;">
                                <canvas id="graficoMaterias"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin: Gestión de usuarios -->
    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-lg-4">
            <div class="card dashboard-card dashboard-card-admin border-0">
                <div class="card-body text-center">
                    <h5 class="fw-bold mb-2"><i class="bi bi-person-lines-fill me-2"></i>Gestión de Usuarios</h5>
                    <a href="index.php?page=usuarios" class="btn btn-sm dashboard-btn mt-2">
                        <i class="bi bi-people me-1"></i> Ver usuarios
                    </a>

                    <!--<div class="text-center mt-4">
                        <a href="cargar_materias_iniciales.php" class="btn btn-outline-primary">
                             <i class="bi bi-box-arrow-in-down"></i> Cargar Materias por Defecto
                         </a>
                    </div>-->

                    
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center mt-5 py-3">
    <small>Sistema Colegio - Desarrollado por Daniel Zapata © <?= date('Y') ?></small>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficoMaterias').getContext('2d');
    const chartMaterias = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($materiasPorProfesor, 'profesor')) ?>,
            datasets: [{
                label: 'Materias Asignadas',
                data: <?= json_encode(array_column($materiasPorProfesor, 'total')) ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                borderRadius: 6,
                barPercentage: 0.6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    ticks: {
                        color: '#333',
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        color: '#333',
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true },
                title: {
                    display: true,
                    text: 'Distribución de Materias por Profesor',
                    color: '#222',
                    font: {
                        size: 16,
                        weight: 'bold'
                    }
                }
            }
        }
    });
</script>

</body>
</html>
