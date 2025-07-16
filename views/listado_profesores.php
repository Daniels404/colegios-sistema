<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php include 'views/layout/header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center"><i class="bi bi-person-lines-fill me-2"></i> Lista de Profesores</h2>

    <table class="table table-bordered table-hover text-center align-middle shadow">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Contacto</th>
                <th>Correo</th>
                <th>RH</th>
                <th>Estudiantes</th>
                <th>Jornada</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($profesores as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['nombre']) ?></td>
                    <td><?= htmlspecialchars($p['documento']) ?></td>
                    <td><?= htmlspecialchars($p['contacto']) ?></td>
                    <td><?= htmlspecialchars($p['correo']) ?></td>
                    <td><?= htmlspecialchars($p['rh']) ?></td>
                    <td><?= htmlspecialchars($p['numero_estudiantes']) ?></td>
                    <td><?= htmlspecialchars($p['jornada']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="index.php?page=registro_profesor" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Nuevo Profesor</a>
        <a href="index.php?page=dashboard" class="btn btn-secondary ms-2"><i class="bi bi-arrow-left-circle me-1"></i> Volver</a>
    </div>
</div>

<?php include 'views/layout/footer.php'; ?>
