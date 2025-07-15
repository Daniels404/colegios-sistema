
<?php if (session_status() === PHP_SESSION_NONE) session_start();
include 'views/layout/header.php';
?>

<h2 class="mb-4"><i class="bi bi-card-list me-1"></i> Listado de Estudiantes</h2>

<?php if (!empty($estudiantes)): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Ficha</th>
                    <th>Nombre del Alumno</th>
                    <th>Grado</th>
                    <th>Colegio</th>
                    <th>Jornada</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estudiantes as $est): ?>
                    <tr>
                        <td><?= htmlspecialchars($est['nombre']) ?></td>
                        <td><?= htmlspecialchars($est['ficha']) ?></td>
                        <td><?= htmlspecialchars($est['nombre_alumno']) ?></td>
                        <td><?= htmlspecialchars($est['grado']) ?></td>
                        <td><?= htmlspecialchars($est['colegio']) ?></td>
                        <td><?= htmlspecialchars($est['jornada']) ?></td>
                        <td><?= htmlspecialchars($est['correo']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-warning">No hay estudiantes registrados aún.</div>
<?php endif; ?>
